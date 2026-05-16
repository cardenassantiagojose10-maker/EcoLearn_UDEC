<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private array $responses = [
        'es' => [
            'greeting' => [
                'keys' => ['hola', 'buenos días', 'buenos dias', 'buenas tardes', 'buenas noches', 'buenas', 'saludos', 'hey'],
                'text' => "¡Hola! Soy **EcoBot**, tu asistente en EcoLearn UDEC. 🌱\n\n*\"Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes.\"*\n\nEsta filosofía guía todo lo que hacemos aquí. ¿En qué puedo ayudarte? Escribe **ayuda** para ver todas las opciones.",
            ],
            'about' => [
                'keys' => ['ecolearn', 'plataforma', 'qué es', 'que es', 'sistema', 'acerca', 'sobre'],
                'text' => "🌿 **EcoLearn UDEC** es una plataforma educativa de gestión del conocimiento orientada a:\n\n• Educación ambiental\n• Desarrollo humano sostenible\n• Formación de ciudadanos autónomos y éticos\n\nAquí puedes acceder a cursos, gestionar tareas, seguir tu progreso y crecer como persona.",
            ],
            'courses' => [
                'keys' => ['curso', 'cursos', 'aprender', 'lección', 'lecciones', 'módulo', 'contenido', 'estudiar', 'materia'],
                'text' => "📚 Los **cursos** de EcoLearn están diseñados para transformar tu comprensión del medio ambiente.\n\nCada curso incluye:\n• Módulos de contenido estructurado\n• Evaluaciones de aprendizaje\n• Seguimiento de tu progreso\n\nAccede desde el menú lateral → **Cursos**.",
            ],
            'tasks' => [
                'keys' => ['tarea', 'tareas', 'actividad', 'pendiente', 'to-do', 'hacer'],
                'text' => "✅ El módulo de **Tareas** te permite organizar tu aprendizaje de forma autónoma.\n\nPuedes:\n• Crear nuevas tareas\n• Marcarlas como completadas\n• Editar o eliminar tareas\n\nLa autogestión es clave para la autonomía. Accede desde el menú → **Tareas**.",
            ],
            'progress' => [
                'keys' => ['progreso', 'avance', 'estadística', 'resultado', 'logro', 'puntaje', 'calificación', 'nota'],
                'text' => "📊 Tu **Progreso** refleja tu evolución en EcoLearn.\n\nPuedes ver:\n• Cursos completados\n• Puntajes en evaluaciones\n• Tareas realizadas\n\nEl autoconocimiento a través del progreso es parte del desarrollo humano. Accede desde → **Progreso**.",
            ],
            'declaration' => [
                'keys' => ['declaración', 'declaracion', 'transhumana', 'libre', 'autónomo', 'autonomo', 'responsable', 'propias leyes', 'filosof', 'principio', 'ideal regulativo'],
                'text' => "🧠 **Declaración Persona Transhumana**\n\n*\"Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes.\"*\n\nEsta declaración orienta EcoLearn:\n\n🔹 **Libertad** — elegir tu propio camino de aprendizaje\n🔹 **Autonomía** — autodirigirte y autorregularte\n🔹 **Responsabilidad** — hacia ti, los demás y el planeta\n🔹 **Diálogo** — como herramienta para construir conocimiento\n🔹 **Construcción** — de un futuro mejor a través de la educación",
            ],
            'ethics' => [
                'keys' => ['ética', 'etica', 'ético', 'moral', 'valores', 'valor', 'principios éticos'],
                'text' => "⚖️ La **ética** es un pilar fundamental de EcoLearn.\n\nNuestros cursos integran:\n• Reflexión crítica sobre el impacto ambiental\n• Valores de respeto hacia la naturaleza\n• Responsabilidad intergeneracional\n• Toma de decisiones éticas\n\nSer ético es actuar con coherencia entre lo que piensas, lo que dices y lo que haces.",
            ],
            'autonomy' => [
                'keys' => ['autonomía', 'autonomia', 'independencia', 'autogestión', 'autogestion', 'autorregulación', 'autodirección'],
                'text' => "🦋 La **autonomía** es la capacidad de dirigir tu propio aprendizaje y vida.\n\nEn EcoLearn la practicas:\n• Eligiendo cuándo y cómo estudiar\n• Gestionando tus propias tareas\n• Reflexionando sobre tu progreso\n• Tomando decisiones informadas\n\n*\"Me dirijo, controlo y dicto mis propias leyes.\"*",
            ],
            'wellbeing' => [
                'keys' => ['bienestar', 'salud', 'felicidad', 'equilibrio', 'balance', 'cuidado'],
                'text' => "🌟 El **bienestar** integral es un objetivo central en EcoLearn.\n\nEl bienestar incluye:\n• Bienestar emocional y mental\n• Conexión con el entorno natural\n• Relaciones saludables con la comunidad\n• Equilibrio entre aprendizaje y descanso\n\nCuidar tu bienestar es un acto de responsabilidad personal y social.",
            ],
            'human_dev' => [
                'keys' => ['desarrollo humano', 'crecimiento', 'evolución', 'evolución personal', 'formación', 'transformación', 'transformacion'],
                'text' => "🌱 El **desarrollo humano** es el corazón de EcoLearn.\n\nBuscamos formar personas que:\n• Evolucionen continuamente en conocimiento y valores\n• Se transformen positivamente a través del aprendizaje\n• Contribuyan al bienestar colectivo\n• Sean agentes de cambio en su entorno\n\nCada curso y tarea es una oportunidad de crecimiento.",
            ],
            'social_resp' => [
                'keys' => ['responsabilidad social', 'comunidad', 'sociedad', 'impacto', 'ciudadanía', 'ciudadania', 'colectivo'],
                'text' => "🤝 La **responsabilidad social** es inseparable del aprendizaje ambiental.\n\nSignifica:\n• Tomar decisiones conscientes de su impacto en otros\n• Contribuir activamente a tu comunidad\n• Defender el medio ambiente como patrimonio colectivo\n• Actuar con coherencia entre lo que aprendes y lo que haces\n\n*\"...soy RESPONSABLE a través del diálogo y la construcción.\"*",
            ],
            'help' => [
                'keys' => ['ayuda', 'opciones', 'menú', 'menu', 'comandos', 'qué puedes', 'que puedes'],
                'text' => "🆘 **¿En qué puedo ayudarte?**\n\nPregúntame sobre:\n\n📚 **cursos** · ✅ **tareas** · 📊 **progreso**\n🧠 **declaración** · ⚖️ **ética** · 🦋 **autonomía**\n🌟 **bienestar** · 🌱 **desarrollo humano**\n🤝 **responsabilidad social** · 🌿 **ecolearn**\n\n💬 Escribe **english** para cambiar al inglés.",
            ],
            'farewell' => [
                'keys' => ['adiós', 'adios', 'chao', 'hasta luego', 'hasta pronto', 'chau', 'nos vemos'],
                'text' => "👋 ¡Hasta pronto! Recuerda:\n\n*Eres LIBRE, AUTÓNOMO Y RESPONSABLE.*\n\n¡Sigue aprendiendo y transformando el mundo! 🌍🌱",
            ],
            'default' => "💬 No estoy seguro de entender tu pregunta, pero estoy aquí para ayudarte.\n\nEscribe **ayuda** para ver mis opciones, o pregúntame sobre: cursos, tareas, progreso, ética, autonomía, bienestar o nuestra filosofía.",
        ],

        'en' => [
            'greeting' => [
                'keys' => ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening', 'greetings'],
                'text' => "Hello! I'm **EcoBot**, your learning assistant at EcoLearn UDEC. 🌱\n\n*\"I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulative ideal; I lead, control and dictate my own laws.\"*\n\nThis philosophy guides everything we do here. How can I help you? Type **help** to see all options.",
            ],
            'about' => [
                'keys' => ['ecolearn', 'platform', 'what is', 'system', 'about'],
                'text' => "🌿 **EcoLearn UDEC** is an educational knowledge management platform focused on:\n\n• Environmental education\n• Sustainable human development\n• Training autonomous and ethical citizens\n\nHere you can access courses, manage tasks, track your progress, and grow as a person.",
            ],
            'courses' => [
                'keys' => ['course', 'courses', 'learn', 'lesson', 'lessons', 'module', 'content', 'study'],
                'text' => "📚 EcoLearn **courses** are designed to transform your understanding of the environment.\n\nEach course includes:\n• Structured content modules\n• Learning evaluations\n• Progress tracking\n\nAccess from the sidebar → **Courses**.",
            ],
            'tasks' => [
                'keys' => ['task', 'tasks', 'activity', 'activities', 'pending', 'to-do', 'todo'],
                'text' => "✅ The **Tasks** module lets you organize your learning autonomously.\n\nYou can:\n• Create new tasks\n• Mark them as completed\n• Edit or delete tasks\n\nSelf-management is key to autonomy. Access from the menu → **Tasks**.",
            ],
            'progress' => [
                'keys' => ['progress', 'advance', 'statistics', 'result', 'achievement', 'score', 'grade'],
                'text' => "📊 Your **Progress** reflects your evolution in EcoLearn.\n\nYou can see:\n• Completed courses\n• Evaluation scores\n• Completed tasks\n\nSelf-knowledge through progress is part of human development. Access from → **Progress**.",
            ],
            'declaration' => [
                'keys' => ['declaration', 'transhuman', 'free', 'autonomous', 'responsible', 'own laws', 'philosophy', 'principle', 'regulative ideal'],
                'text' => "🧠 **Transhuman Person Declaration**\n\n*\"I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulative ideal; I lead, control and dictate my own laws.\"*\n\nThis declaration guides EcoLearn:\n\n🔹 **Freedom** — to choose your own learning path\n🔹 **Autonomy** — to self-direct and self-regulate\n🔹 **Responsibility** — toward yourself, others, and the planet\n🔹 **Dialogue** — as a tool for building knowledge\n🔹 **Construction** — of a better future through education",
            ],
            'ethics' => [
                'keys' => ['ethics', 'ethical', 'moral', 'values', 'value', 'principles'],
                'text' => "⚖️ **Ethics** is a fundamental pillar of EcoLearn.\n\nOur courses integrate:\n• Critical reflection on environmental impact\n• Values of respect toward nature\n• Intergenerational responsibility\n• Ethical decision-making\n\nBeing ethical means acting with consistency between what you think, say, and do.",
            ],
            'autonomy' => [
                'keys' => ['autonomy', 'autonomous', 'independence', 'self-management', 'self-regulation', 'self-direction'],
                'text' => "🦋 **Autonomy** is the capacity to direct your own learning and life.\n\nIn EcoLearn you practice it by:\n• Choosing when and how to study\n• Managing your own tasks\n• Reflecting on your progress\n• Making informed decisions\n\n*\"I lead, control and dictate my own laws.\"*",
            ],
            'wellbeing' => [
                'keys' => ['wellbeing', 'well-being', 'health', 'happiness', 'balance', 'wellness'],
                'text' => "🌟 Integral **wellbeing** is a central objective at EcoLearn.\n\nWellbeing includes:\n• Emotional and mental wellbeing\n• Connection with the natural environment\n• Healthy relationships with the community\n• Balance between learning and rest\n\nCaring for your wellbeing is an act of personal and social responsibility.",
            ],
            'human_dev' => [
                'keys' => ['human development', 'growth', 'personal evolution', 'formation', 'transformation'],
                'text' => "🌱 **Human development** is the heart of EcoLearn.\n\nWe seek to form people who:\n• Continuously evolve in knowledge and values\n• Transform positively through learning\n• Contribute to collective wellbeing\n• Are agents of change in their environment\n\nEvery course and task is an opportunity for growth.",
            ],
            'social_resp' => [
                'keys' => ['social responsibility', 'community', 'society', 'impact', 'citizenship', 'collective'],
                'text' => "🤝 **Social responsibility** is inseparable from environmental learning.\n\nIt means:\n• Making decisions aware of their impact on others\n• Actively contributing to your community\n• Defending the environment as collective heritage\n• Acting with consistency between what you learn and what you do\n\n*\"...I am RESPONSIBLE through dialogue and construction.\"*",
            ],
            'help' => [
                'keys' => ['help', 'options', 'menu', 'commands', 'what can you'],
                'text' => "🆘 **How can I help you?**\n\nAsk me about:\n\n📚 **courses** · ✅ **tasks** · 📊 **progress**\n🧠 **declaration** · ⚖️ **ethics** · 🦋 **autonomy**\n🌟 **wellbeing** · 🌱 **human development**\n🤝 **social responsibility** · 🌿 **ecolearn**\n\n💬 Type **español** to switch to Spanish.",
            ],
            'farewell' => [
                'keys' => ['goodbye', 'bye', 'farewell', 'see you', 'later', 'cya'],
                'text' => "👋 Goodbye! Remember:\n\n*You are FREE, AUTONOMOUS AND RESPONSIBLE.*\n\nKeep learning and transforming the world! 🌍🌱",
            ],
            'default' => "💬 I'm not sure I understand your question, but I'm here to help.\n\nType **help** to see my options, or ask me about: courses, tasks, progress, ethics, autonomy, wellbeing, or our philosophy.",
        ],
    ];

    public function respond(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $raw  = trim($request->input('message'));
        $msg  = mb_strtolower($raw);
        $lang = $request->input('lang', 'es');

        if (!in_array($lang, ['es', 'en'])) {
            $lang = 'es';
        }

        // Language-switch commands
        if (in_array($msg, ['english', 'en', 'inglés', 'ingles'])) {
            return response()->json([
                'text' => "🌐 Switched to English! I'm EcoBot. Type **help** to see what I can do.",
                'lang' => 'en',
            ]);
        }

        if (in_array($msg, ['español', 'espanol', 'es', 'spanish'])) {
            return response()->json([
                'text' => "🌐 ¡Cambiado al español! Soy EcoBot. Escribe **ayuda** para ver qué puedo hacer.",
                'lang' => 'es',
            ]);
        }

        $langData = $this->responses[$lang];

        foreach ($langData as $key => $item) {
            if ($key === 'default' || !isset($item['keys'])) {
                continue;
            }
            foreach ($item['keys'] as $keyword) {
                if (str_contains($msg, $keyword)) {
                    return response()->json(['text' => $item['text'], 'lang' => $lang]);
                }
            }
        }

        return response()->json(['text' => $langData['default'], 'lang' => $lang]);
    }
}
