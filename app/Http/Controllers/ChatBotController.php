<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    private $userName = null;
    private $temporaryData = [];
    
    public function respond(Request $request)
    {
        $message = strtolower(trim($request->input('message')));
        $sessionId = $request->session()->getId();
        
        if ($this->isInConversationFlow($sessionId)) {
            return $this->handleConversationFlow($sessionId, $message);
        }
        
        $response = $this->generateResponse($message, $sessionId);
        
        return response()->json(['response' => $response]);
    }
    
    protected function generateResponse($message, $sessionId)
    {
        // Saludos y captura de nombre
        if ($this->matchesAny($message, ['hola', 'buenos días', 'buenas tardes', 'hi', 'hello'])) {
            if (!$this->userName) {
                $this->setTemporaryData($sessionId, 'awaiting_name', true);
                return '¡Hola! Soy tu asistente del estudio de tatuajes. ¿En qué puedo ayudarte hoy?';
            }
            return "¡Hola {$this->userName}! ¿En qué puedo ayudarte hoy?";
        }
        
        if ($this->getTemporaryData($sessionId, 'awaiting_name')) {
            $this->userName = ucwords(trim($message));
            $this->setTemporaryData($sessionId, 'awaiting_name', false);
            return "Mucho gusto {$this->userName}. ¿Qué información necesitas hoy? Puedo ayudarte con:\n"
                . "🔹 Reservas y citas\n"
                . "🔹 Cuidados del tatuaje\n"
                . "🔹 Artistas y estilos\n"
                . "🔹 Diseños personalizados\n"
                . "🔹 Precios y promociones";
        }
        
        // Funcionalidades principales
        if ($this->matchesAny($message, ['reserva', 'agendar', 'cita', 'turno', 'hacer una cita'])) {
            return $this->handleAppointmentRequest($sessionId);
        }
        
        if ($this->matchesAny($message, ['artista', 'especialidad', 'diseñador', 'quién hace', 'especialista'])) {
            return $this->handleArtistInquiry($sessionId);
        }
        
        if ($this->matchesAny($message, ['precio', 'costo', 'cuánto cuesta', 'presupuesto', 'a cuanto'])) {
            return $this->handlePricingInquiry($message);
        }
        
        if ($this->matchesAny($message, ['cuidados', 'cuidar', 'después del tatuaje', 'post tattoo'])) {
            return $this->handleAftercareInstructions($message);
        }
        
        // Información adicional
        if ($this->matchesAny($message, ['riesgo', 'peligro', 'infección', 'alergia', 'complicación'])) {
            return $this->handleHealthRisksInfo($message);
        }
        
        if ($this->matchesAny($message, ['curación', 'tiempo de cura', 'sanar', 'cicatrizar'])) {
            return $this->handleHealingProcessInfo();
        }
        
        if ($this->matchesAny($message, ['diseño', 'idea', 'motivo', 'qué tatuarme'])) {
            return $this->handleDesignAdvice($message);
        }
        
        if ($this->matchesAny($message, ['horario', 'ubicación', 'dirección', 'contacto'])) {
            return $this->handleStudioInfo();
        }
        
        if ($this->matchesAny($message, ['máquina', 'agujas', 'tinta', 'materiales'])) {
            return $this->handleTechnicalQuestions($message);
        }
        
        if ($this->matchesAny($message, ['cubrir', 'cover up', 'tatuaje viejo'])) {
            return $this->handleCoverUpInfo();
        }
        
        if ($this->matchesAny($message, ['temporal', 'henna', 'fake tattoo'])) {
            return $this->handleTemporaryTattoos();
        }
        
        // Despedidas
        if ($this->matchesAny($message, ['gracias', 'agradecido', 'thanks'])) {
            return $this->generateThankYouResponse();
        }
        
        if ($this->matchesAny($message, ['adiós', 'chao', 'hasta luego', 'bye'])) {
            return $this->generateGoodbyeMessage();
        }
        
        // Búsqueda en FAQs
        $faqMatch = Faq::where('question', 'like', "%{$message}%")->first();
        if ($faqMatch) {
            return $faqMatch->answer;
        }
        
        // Respuesta por defecto
        return $this->handleUnknownQuestion($message);
    }
    
    // ========== MÉTODOS DE MANEJO ==========
    
    private function handleAppointmentRequest($sessionId)
    {
        $this->setTemporaryData($sessionId, 'reserva_flow', true);
        return "Perfecto {$this->userName}, vamos a agendar tu cita. ¿Prefieres:\n"
            . "1️⃣ Tatuaje personalizado (necesitamos diseñarlo)\n"
            . "2️⃣ Tatuaje de catálogo\n"
            . "3️⃣ Piercing o body modification\n"
            . "4️⃣ Solo quiero información";
    }
    
    private function handleArtistInquiry($sessionId)
    {
        $this->setTemporaryData($sessionId, 'artist_flow', true);
        return "Tenemos especialistas en diferentes estilos:\n"
            . "✏️ Tradicional/Americano\n"
            . "🎨 Realismo/Retratos\n"
            . "⚫ Black & Grey\n"
            . "💮 Japonés\n"
            . "🔠 Lettering/Caligrafía\n"
            . "💉 Minimalista/Fino\n"
            . "🌿 Dotwork/Geométrico\n"
            . "¿Qué estilo te interesa?";
    }
    
    private function handlePricingInquiry($message)
    {
        if ($this->matchesAny($message, ['pequeño', 'chico', 'simple'])) {
            return "Para tatuajes pequeños (hasta 10cm):\n"
                . "💵 Desde \$50 - \$150\n"
                . "⏱️ 30-60 minutos\n"
                . "Incluye diseño simple y una sesión";
        } elseif ($this->matchesAny($message, ['mediano', 'normal'])) {
            return "Tatuajes medianos (10-20cm):\n"
                . "💵 \$150 - \$400\n"
                . "⏱️ 1-3 horas\n"
                . "Puede requerir 1-2 sesiones";
        } elseif ($this->matchesAny($message, ['grande', 'complejo', 'manga'])) {
            return "Tatuajes grandes/complejos:\n"
                . "💵 \$400 - \$2000+\n"
                . "⏱️ Múltiples sesiones\n"
                . "Precio varía por diseño y artista";
        } else {
            return "Los precios dependen de:\n"
                . "📏 Tamaño del diseño\n"
                . "🎨 Complejidad y detalles\n"
                . "👨‍🎨 Artista seleccionado\n"
                . "💪 Parte del cuerpo\n"
                . "\nEjemplos:\n"
                . "• Letra pequeña: \$50-\$80\n"
                . "• Símbolo 5cm: \$80-\$120\n"
                . "• Manga completa: \$1000+\n"
                . "\n¿Quieres cotizar algo específico?";
        }
    }
    
    private function handleAftercareInstructions($message)
    {
        if ($this->matchesAny($message, ['primeros días', 'inicio'])) {
            return "Primeros 3 días:\n"
                . "1️⃣ Retira el vendaje después de 2-3 horas\n"
                . "2️⃣ Lava suavemente con agua tibia y jabón neutro\n"
                . "3️⃣ Seca con toques (no frotes)\n"
                . "4️⃣ Aplica crema recomendada (capa fina)\n"
                . "5️⃣ Repite 2-3 veces al día";
        } elseif ($this->matchesAny($message, ['costra', 'picazón'])) {
            return "Fase de costras (días 4-14):\n"
                . "• Es normal que se forme costra y pique\n"
                . "• NO RASQUES aunque pique mucho\n"
                . "• Sigue hidratando con crema\n"
                . "• Evita ropa ajustada en la zona";
        } else {
            return "Cuidados esenciales:\n"
                . "🧼 Higiene: Lava 2-3 veces/día\n"
                . "💧 Hidratación: Crema especializada\n"
                . "👕 Ropa: Holgada y de algodón\n"
                . "🚫 Evita: Sol, cloro, rascar\n"
                . "⏳ Curación completa: 4 semanas";
        }
    }
    
    private function handleHealthRisksInfo($message)
    {
        if ($this->matchesAny($message, ['infección', 'pus'])) {
            return "Signos de infección:\n"
                . "🔴 Enrojecimiento extremo\n"
                . "🔥 Calor localizado\n"
                . "💉 Secreción amarilla/verde\n"
                . "\nSi notas esto:\n"
                . "1. Limpia con agua y jabón\n"
                . "2. Aplica antiséptico\n"
                . "3. Consulta a un médico";
        } elseif ($this->matchesAny($message, ['alergia', 'reacción'])) {
            return "Reacciones alérgicas:\n"
                . "• Raras (usamos tintas hipoalergénicas)\n"
                . "• Pueden aparecer hasta 72h después\n"
                . "• Síntomas: Picazón extrema, hinchazón";
        } else {
            return "Riesgos potenciales:\n"
                . "🦠 Infección (si no se cuida bien)\n"
                . "🤧 Reacción alérgica (raro)\n"
                . "〰 Cicatrización irregular\n"
                . "\nPrevención:\n"
                . "• Estudio profesional\n"
                . "• Materiales esterilizados";
        }
    }
    
    private function handleHealingProcessInfo()
    {
        return "Proceso de curación:\n"
            . "1️⃣ Primeros 3 días: Sensibilidad\n"
            . "2️⃣ Días 4-14: Descamación\n"
            . "3️⃣ Semanas 2-4: Piel renovada\n"
            . "4️⃣ Mes 1-2: Colores asentados\n"
            . "\n¿Necesitas detalles sobre alguna etapa?";
    }
    
    private function handleDesignAdvice($message)
    {
        if ($this->matchesAny($message, ['pequeño', 'minimalista'])) {
            return "Para tatuajes pequeños:\n"
                . "• Ubicaciones: Muñeca, oreja, costillas\n"
                . "• Diseños: Símbolos finos, letras\n"
                . "• Tamaño ideal: 3-8 cm\n"
                . "\n¿Tienes alguna idea en mente?";
        }

        return "Para elegir tu diseño:\n"
            . "1. Piensa en el **significado**\n"
            . "2. Elige un **estilo**\n"
            . "3. Decide la **ubicación**\n"
            . "4. Considera el **tamaño**\n"
            . "\n¿Quieres ver algunos diseños populares?";
    }
    
    private function handleStudioInfo()
    {
        return "Información del estudio:\n"
            . "📍 Dirección: Calle del Tatuaje 123\n"
            . "🕒 Horarios: L-V 11am-8pm, S 10am-6pm\n"
            . "📞 Teléfono: 000000000\n"
            . "📧 Email: hignacio@gmail.com\n"
            . "Instagram: @InkMasterOficial\n"
            . "\n¿Necesitas ayuda con direcciones?";
    }
    
    private function handleTechnicalQuestions($message)
    {
        if ($this->matchesAny($message, ['tinta', 'pigmentos'])) {
            return "Nuestras tintas:\n"
                . "• Hipoalergénicas\n"
                . "• Veganas\n"
                . "• Certificadas\n"
                . "• Colores vibrantes";
        }

        return "Equipo técnico:\n"
            . "🔹 Máquinas rotativas\n"
            . "🔹 Agujas estériles\n"
            . "🔹 Esterilización hospitalaria\n"
            . "\n¿Qué aspecto te interesa?";
    }
    
    private function handleCoverUpInfo()
    {
        return "Cover-ups:\n"
            . "✅ Se puede cubrir la mayoría\n"
            . "🔄 Evaluamos tu tatuaje actual\n"
            . "🎨 Opciones:\n"
            . "   - Diseño nuevo\n"
            . "   - Aclarado láser\n"
            . "   - Modificación\n"
            . "\n¿Qué tatuaje quieres cubrir?";
    }
    
    private function handleTemporaryTattoos()
    {
        return "Opciones no permanentes:\n"
            . "🌿 Henna natural (1-3 semanas)\n"
            . "✨ Tatuajes temporales (7 días)\n"
            . "🎨 Prueba de diseño\n"
            . "\n¿Te interesa alguna?";
    }
    
    private function generateThankYouResponse()
    {
        $responses = [
            "¡De nada {$this->userName}! Estamos para servirte.",
            "Fue un placer ayudarte. ¡Vuelve cuando quieras!",
            "Gracias a ti. ¿Necesitas algo más?"
        ];
        return $responses[array_rand($responses)];
    }
    
    private function generateGoodbyeMessage()
    {
        $greetings = [
            "¡Hasta luego {$this->userName}! Esperamos verte pronto.",
            "Nos vemos, {$this->userName}. Recuerda los cuidados.",
            "Que tengas un excelente día, {$this->userName}."
        ];
        return $greetings[array_rand($greetings)];
    }
    
    private function handleUnknownQuestion($message)
    {
        return "Lo siento, no entendí completamente tu pregunta. ¿Podrías reformularla?\n"
            . "Puedo ayudarte con información sobre:\n"
            . "• Reservas y citas\n"
            . "• Cuidados del tatuaje\n"
            . "• Artistas y estilos\n"
            . "• Precios y promociones";
    }
    
    // ========== MÉTODOS AUXILIARES ==========
    
    private function isInConversationFlow($sessionId)
    {
        return isset($this->temporaryData[$sessionId]) && 
              (isset($this->temporaryData[$sessionId]['reserva_flow']) || 
               isset($this->temporaryData[$sessionId]['artist_flow']));
    }
    
    private function handleConversationFlow($sessionId, $message)
    {
        if ($this->getTemporaryData($sessionId, 'reserva_flow')) {
            return $this->handleAppointmentFlow($sessionId, $message);
        }
        
        if ($this->getTemporaryData($sessionId, 'artist_flow')) {
            return $this->handleArtistFlow($sessionId, $message);
        }
        
        return "Respuesta de flujo conversacional";
    }
    
    private function handleAppointmentFlow($sessionId, $message)
    {
        // Lógica para completar reserva
        $this->setTemporaryData($sessionId, 'reserva_flow', false);
        return "Gracias por la información. Hemos registrado tu preferencia y pronto nos contactaremos contigo.";
    }
    
    private function handleArtistFlow($sessionId, $message)
    {
        // Lógica para recomendar artistas
        $this->setTemporaryData($sessionId, 'artist_flow', false);
        return "Para el estilo que mencionas, te recomendaría a nuestros artistas:\n"
            . "• Juan Pérez - Especialista en el estilo\n"
            . "• María Gómez - Excelente para diseños personalizados\n"
            . "\n¿Quieres ver sus portafolios o agendar con alguno?";
    }
    
    private function setTemporaryData($sessionId, $key, $value)
    {
        $this->temporaryData[$sessionId][$key] = $value;
    }
    
    private function getTemporaryData($sessionId, $key)
    {
        return $this->temporaryData[$sessionId][$key] ?? null;
    }
    
    private function matchesAny($message, array $keywords)
    {
        foreach ($keywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }
        return false;
    }
    
    private function buildResponse($mainText, $context, $suggestions = [])
    {
        $response = $mainText;
        
        if (!empty($suggestions)) {
            $response .= "\n\nTambién podrías preguntar:\n";
            foreach ($suggestions as $suggestion) {
                $response .= "• {$suggestion}\n";
            }
        }
        
        return $response;
    }
}