<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Course::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Course::create([
            'title'       => 'Uso responsable de la tecnología y sostenibilidad',
            'description' => 'Descubre cómo tus hábitos digitales impactan el planeta y aprende estrategias concretas para reducir tu huella tecnológica. Este curso te entrega herramientas prácticas para ser un ciudadano digital responsable y comprometido con el medio ambiente.',
            'content'     => [
                'expected_result' => 'Al finalizar, el estudiante comprenderá el impacto ambiental de la tecnología y aplicará hábitos digitales sostenibles en su vida universitaria y cotidiana.',
                'modules' => [
                    [
                        'number'  => 1,
                        'title'   => 'Huella digital y consumo energético',
                        'icon'    => 'bi-plug-fill',
                        'color'   => '#006837',
                        'content' => 'Cada dispositivo tecnológico consume energía durante todo su ciclo de vida: fabricación, transporte, uso y disposición final. El streaming de video representa el 60% del tráfico de internet global y genera millones de toneladas de CO₂ al año. Optimizar el uso de dispositivos, reducir el brillo de pantallas, activar modos de ahorro energético y cerrar aplicaciones en segundo plano son acciones concretas que marcan la diferencia. Los centros de datos que almacenan la nube mundial consumen más electricidad que muchos países enteros.',
                        'key_points' => [
                            'El 70% del consumo energético de un dispositivo ocurre durante su fabricación.',
                            'Una hora de videollamada emite aprox. 150 g de CO₂.',
                            'Reducir la resolución del streaming puede bajar el consumo de datos hasta un 70%.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-journal-check',
                            'type'        => 'Reflexión práctica',
                            'description' => 'Durante 3 días consecutivos, registra el tiempo diario que utilizas tu smartphone, computador y otros dispositivos. Calcula el total de horas semanales y reflexiona en un párrafo sobre qué acciones concretas podrías adoptar para reducir tu consumo energético digital.',
                        ],
                        'quiz' => [
                            'question'    => '¿En qué etapa del ciclo de vida de un dispositivo se concentra la mayor parte de su huella energética?',
                            'options'     => [
                                'A' => 'Durante el uso diario del dispositivo.',
                                'B' => 'Durante su fabricación.',
                                'C' => 'Durante el transporte hasta la tienda.',
                                'D' => 'Durante el reciclaje final.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Cerca del 70% del consumo energético total de un dispositivo ocurre en su fabricación, por eso extender su vida útil es la acción más efectiva.',
                        ],
                    ],
                    [
                        'number'  => 2,
                        'title'   => 'Residuos electrónicos (e-waste)',
                        'icon'    => 'bi-recycle',
                        'color'   => '#1a7a4a',
                        'content' => 'Los residuos electrónicos (e-waste) son uno de los flujos de basura de crecimiento más rápido del mundo: se generan más de 53 millones de toneladas anuales. Contienen materiales valiosos como oro, plata y cobre, pero también sustancias tóxicas como mercurio, plomo y cadmio. Botar un celular al basurero contamina el suelo y el agua. La reparación, reutilización y reciclaje de dispositivos es fundamental. En Chile existen puntos limpios habilitados para depositar dispositivos en desuso de forma segura.',
                        'key_points' => [
                            'Solo el 17% del e-waste mundial se recicla formalmente.',
                            'Un celular contiene más de 60 elementos de la tabla periódica.',
                            'Reparar un equipo puede extender su vida útil entre 3 y 5 años adicionales.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-geo-alt-fill',
                            'type'        => 'Investigación comunitaria',
                            'description' => 'Busca en tu ciudad al menos un punto limpio o programa de reciclaje de electrónicos (municipio, supermercado, tiendas de tecnología). Comparte la dirección y horarios con mínimo 5 personas de tu entorno familiar o universitario. Documenta la acción con una captura de pantalla o foto.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué porcentaje del e-waste generado en el mundo se recicla formalmente?',
                            'options'     => [
                                'A' => 'Alrededor del 17%.',
                                'B' => 'Cerca del 90%.',
                                'C' => 'Aproximadamente el 50%.',
                                'D' => 'Prácticamente el 100%.',
                            ],
                            'correct'     => 'A',
                            'explanation' => 'Solo un 17% del e-waste mundial recibe un tratamiento formal de reciclaje; el resto termina en vertederos o circuitos informales que contaminan suelo y agua.',
                        ],
                    ],
                    [
                        'number'  => 3,
                        'title'   => 'Economía circular y tecnología sostenible',
                        'icon'    => 'bi-arrow-repeat',
                        'color'   => '#00924e',
                        'content' => 'La economía circular propone rediseñar el ciclo de vida de los productos para eliminar los residuos desde el diseño, no al final del proceso. En tecnología esto implica fabricar dispositivos reparables y modulares, utilizar materiales reciclados y extender la vida útil de los equipos. Empresas como Fairphone lideran este modelo con teléfonos 100% modulares. Como consumidores universitarios, podemos rechazar la obsolescencia programada eligiendo marcas con mayor compromiso ambiental y optando por la segunda mano cuando sea posible.',
                        'key_points' => [
                            'La obsolescencia programada acorta artificialmente la vida de los dispositivos.',
                            'Comprar de segunda mano puede reducir la huella de carbono hasta un 80%.',
                            'El sello EPEAT certifica equipos electrónicos con criterios ambientales.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-search',
                            'type'        => 'Análisis comparativo',
                            'description' => 'Investiga 3 marcas de tecnología (ej: Apple, Samsung, Fairphone) y compara sus políticas de sustentabilidad ambiental. ¿Ofrecen programas de reciclaje? ¿Usan materiales reciclados? ¿Sus dispositivos son reparables? Presenta tus hallazgos en una tabla comparativa y elige qué marca elegirías como consumidor responsable.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué estrategia refleja mejor el principio de economía circular en tecnología?',
                            'options'     => [
                                'A' => 'Diseñar dispositivos reparables y modulares que extienden su vida útil.',
                                'B' => 'Lanzar un modelo nuevo cada año para incentivar el consumo.',
                                'C' => 'Fabricar equipos sellados que no puedan abrirse ni repararse.',
                                'D' => 'Reducir la garantía de los productos a 3 meses.',
                            ],
                            'correct'     => 'A',
                            'explanation' => 'La economía circular busca que los productos se mantengan en uso el mayor tiempo posible mediante diseño reparable, modular y con materiales reciclados.',
                        ],
                    ],
                    [
                        'number'  => 4,
                        'title'   => 'Inteligencia artificial y su huella ambiental',
                        'icon'    => 'bi-cpu-fill',
                        'color'   => '#0a6b45',
                        'content' => 'Entrenar y ejecutar modelos de inteligencia artificial requiere enormes cantidades de energía y agua para refrigerar los centros de datos que los alojan. Entrenar un solo modelo de lenguaje de gran tamaño puede emitir tanto CO₂ como cinco automóviles durante toda su vida útil, y cada consulta a un chatbot de IA consume decenas de mililitros de agua para enfriamiento. Usar la IA de forma consciente —evitando consultas repetitivas o innecesarias y prefiriendo modelos más eficientes cuando sea posible— es parte de una ciudadanía digital responsable.',
                        'key_points' => [
                            'Entrenar un modelo de IA grande puede emitir tanto CO₂ como 5 autos en toda su vida útil.',
                            'Cada 20-50 consultas a un chatbot de IA pueden consumir alrededor de medio litro de agua para refrigeración.',
                            'Los centros de datos dedicados a IA duplicarán su consumo eléctrico mundial hacia 2030 según proyecciones de la AIE.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-lightbulb-fill',
                            'type'        => 'Diario de uso consciente',
                            'description' => 'Durante una semana, anota cada vez que uses una herramienta de inteligencia artificial (chatbots, generadores de imágenes, asistentes). Al final, identifica al menos 2 consultas que podrías haber evitado o agrupado, y escribe un compromiso personal para un uso más eficiente.',
                        ],
                        'quiz' => [
                            'question'    => '¿Por qué el uso de inteligencia artificial tiene un impacto ambiental relevante?',
                            'options'     => [
                                'A' => 'Porque los centros de datos que la sostienen consumen grandes cantidades de energía y agua.',
                                'B' => 'Porque los chatbots emiten ruido que afecta a la fauna local.',
                                'C' => 'Porque la IA solo se ejecuta en dispositivos móviles.',
                                'D' => 'Porque no tiene ningún impacto ambiental medible.',
                            ],
                            'correct'     => 'A',
                            'explanation' => 'Entrenar y ejecutar modelos de IA demanda gran capacidad de cómputo en centros de datos que consumen electricidad y agua de refrigeración a gran escala.',
                        ],
                    ],
                    [
                        'number'  => 5,
                        'title'   => 'Ciudadanía digital sostenible',
                        'icon'    => 'bi-shield-check',
                        'color'   => '#0c5c3c',
                        'content' => 'Ser un ciudadano digital sostenible implica ir más allá de reducir el consumo: significa adoptar hábitos permanentes como el minimalismo digital (mantener solo las apps y archivos que realmente usas), limpiar periódicamente el correo y la nube para reducir el almacenamiento de datos innecesarios, preferir el Wi-Fi sobre datos móviles cuando sea posible, y compartir estos conocimientos con tu comunidad universitaria. Pequeñas decisiones individuales, multiplicadas por miles de estudiantes, generan un impacto colectivo significativo.',
                        'key_points' => [
                            'Eliminar correos y archivos innecesarios en la nube reduce el gasto energético de los servidores que los almacenan.',
                            'El Wi-Fi consume significativamente menos energía que la red móvil para transmitir la misma cantidad de datos.',
                            'Compartir buenas prácticas digitales amplifica el impacto ambiental positivo dentro de la comunidad universitaria.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-megaphone-fill',
                            'type'        => 'Compromiso y difusión',
                            'description' => 'Elabora un decálogo personal de "ciudadanía digital sostenible" con al menos 5 hábitos que te comprometes a mantener. Compártelo con tu curso o en redes sociales usando el hashtag #EcoLearnUDEC e invita a 2 compañeros a sumarse.',
                        ],
                        'quiz' => [
                            'question'    => '¿Cuál de las siguientes es una práctica de ciudadanía digital sostenible?',
                            'options'     => [
                                'A' => 'Guardar todos los archivos y correos indefinidamente sin revisarlos.',
                                'B' => 'Practicar minimalismo digital y limpiar periódicamente la nube y el correo.',
                                'C' => 'Usar siempre datos móviles en lugar de Wi-Fi.',
                                'D' => 'Evitar compartir buenos hábitos digitales con otras personas.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Mantener solo lo necesario y limpiar periódicamente el almacenamiento en la nube reduce la energía que los centros de datos usan para conservar información innecesaria.',
                        ],
                    ],
                ],
                'evaluation' => [
                    'title'       => 'Evaluación final del curso',
                    'description' => 'Responde las siguientes preguntas para verificar tus aprendizajes.',
                    'questions'   => [
                        [
                            'number'   => 1,
                            'question' => '¿Cuál es el principal impacto ambiental asociado al uso masivo de streaming de video?',
                            'options'  => [
                                'A' => 'Genera residuos plásticos en los océanos.',
                                'B' => 'Consume grandes cantidades de energía y genera emisiones de CO₂.',
                                'C' => 'Contamina directamente el agua potable.',
                                'D' => 'Produce contaminación acústica en los centros de datos.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'Los centros de datos que soportan el streaming global consumen enormes cantidades de electricidad, lo que se traduce en emisiones significativas de gases de efecto invernadero.',
                        ],
                        [
                            'number'   => 2,
                            'question' => '¿Qué son los residuos electrónicos o "e-waste"?',
                            'options'  => [
                                'A' => 'Un software especializado en gestión de reciclaje digital.',
                                'B' => 'Dispositivos electrónicos obsoletos o en desuso que generan residuos tóxicos si no se gestionan correctamente.',
                                'C' => 'Una red de internet de bajo consumo energético.',
                                'D' => 'Programas gubernamentales de ahorro energético.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'El e-waste incluye celulares, computadores, tablets y cualquier dispositivo electrónico que ya no se usa. Contienen materiales valiosos pero también tóxicos que requieren gestión especializada.',
                        ],
                        [
                            'number'   => 3,
                            'question' => '¿Cuál es el principio fundamental de la economía circular aplicada a la tecnología?',
                            'options'  => [
                                'A' => 'Producir, usar y desechar los dispositivos lo más rápido posible para estimular la economía.',
                                'B' => 'Importar tecnología de bajo costo sin considerar su origen ni impacto ambiental.',
                                'C' => 'Rediseñar el ciclo de vida de los productos para eliminar residuos, fomentando la reparación y reutilización.',
                                'D' => 'Depender exclusivamente de energías no renovables para producir más dispositivos.',
                            ],
                            'correct'      => 'C',
                            'explanation'  => 'La economía circular busca que los recursos permanezcan en uso el mayor tiempo posible, eliminando el concepto de "basura" al diseñar productos que puedan ser reparados, reutilizados y reciclados.',
                        ],
                        [
                            'number'   => 4,
                            'question' => '¿Qué recurso natural, además de la energía eléctrica, consumen intensamente los centros de datos que entrenan modelos de inteligencia artificial?',
                            'options'  => [
                                'A' => 'Petróleo.',
                                'B' => 'Agua para refrigeración.',
                                'C' => 'Gas natural directamente en los servidores.',
                                'D' => 'Carbón mineral.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'Los centros de datos requieren grandes volúmenes de agua para refrigerar los servidores que entrenan y ejecutan modelos de inteligencia artificial.',
                        ],
                        [
                            'number'   => 5,
                            'question' => '¿Qué caracteriza a un ciudadano digital sostenible?',
                            'options'  => [
                                'A' => 'Acumula archivos y correos sin límite en la nube.',
                                'B' => 'Adopta hábitos como el minimalismo digital y comparte buenas prácticas con su comunidad.',
                                'C' => 'Evita cualquier tipo de tecnología por completo.',
                                'D' => 'Usa siempre la máxima resolución de video sin importar el contexto.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'La ciudadanía digital sostenible combina hábitos individuales conscientes con la difusión de esas prácticas para generar un impacto colectivo.',
                        ],
                    ],
                ],
            ],
        ]);

        Course::create([
            'title'       => 'Reciclaje y gestión de residuos en el campus universitario',
            'description' => 'Conoce los principios de la separación correcta de residuos, el impacto del reciclaje en el ecosistema y cómo liderar iniciativas de gestión ambiental en tu facultad y comunidad universitaria.',
            'content'     => [
                'expected_result' => 'El estudiante será capaz de clasificar residuos correctamente, promover hábitos de reciclaje en su entorno y diseñar una pequeña iniciativa de gestión de residuos en su facultad.',
                'modules' => [
                    [
                        'number'  => 1,
                        'title'   => 'Las 3R: Reducir, Reutilizar, Reciclar',
                        'icon'    => 'bi-recycle',
                        'color'   => '#006837',
                        'content' => 'La jerarquía de las 3R establece un orden de prioridad: primero reducir la generación de residuos, luego reutilizar lo que ya existe, y finalmente reciclar lo que no puede evitarse. Reducir implica comprar solo lo necesario y rechazar empaques innecesarios. Reutilizar significa darle una segunda vida a los objetos. Reciclar es el último recurso y requiere separación correcta en origen.',
                        'key_points' => [
                            'Reducir es siempre más efectivo que reciclar.',
                            'Una botella de plástico tarda 500 años en degradarse.',
                            'El papel reciclado usa 60% menos energía que el papel virgen.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-clipboard-data',
                            'type'        => 'Auditoría de residuos',
                            'description' => 'Realiza una auditoría de los residuos que generas durante una semana en tu hogar o habitación. Clasifícalos por tipo (orgánico, papel, plástico, vidrio, electrónico) y reflexiona sobre cuáles podrías haber evitado o reutilizado.',
                        ],
                        'quiz' => [
                            'question'    => 'Según la jerarquía de las 3R, ¿cuál debería ser siempre la primera opción?',
                            'options'     => [
                                'A' => 'Reciclar.',
                                'B' => 'Reutilizar.',
                                'C' => 'Reducir.',
                                'D' => 'Incinerar.',
                            ],
                            'correct'     => 'C',
                            'explanation' => 'Reducir la generación de residuos desde el origen es siempre la acción más efectiva, antes de pensar en reutilizar o reciclar.',
                        ],
                    ],
                    [
                        'number'  => 2,
                        'title'   => 'Separación en origen y puntos limpios',
                        'icon'    => 'bi-trash3-fill',
                        'color'   => '#1a7a4a',
                        'content' => 'La separación en origen es el paso más crítico del reciclaje. Si los materiales se mezclan, se contamina toda la fracción y no puede reciclarse. Los colores de contenedores varían por país: en Chile, azul para papel/cartón, amarillo para plásticos y metales, verde para vidrio. Los puntos limpios reciben residuos especiales como pilas, medicamentos y electrónicos que no van al basurero común.',
                        'key_points' => [
                            'Solo el 10% de los chilenos recicla de forma habitual.',
                            'Una pila puede contaminar 600 litros de agua subterránea.',
                            'Separar en origen puede recuperar hasta el 70% de los residuos.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-map',
                            'type'        => 'Mapeo de puntos limpios',
                            'description' => 'Mapea los puntos de reciclaje disponibles dentro de tu campus universitario y en tu barrio. Crea un pequeño directorio con fotografías y compártelo con tus compañeros de curso o en redes sociales usando el hashtag #EcoLearnUDEC.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué ocurre si se mezclan distintos tipos de residuos reciclables en un mismo contenedor?',
                            'options'     => [
                                'A' => 'No pasa nada, la planta de reciclaje los separa igual sin problema.',
                                'B' => 'Se contamina toda la fracción y se dificulta o impide su reciclaje.',
                                'C' => 'Se genera automáticamente compost.',
                                'D' => 'Se convierten en residuos peligrosos.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'La mezcla de materiales contamina la fracción reciclable completa, lo que suele hacer que termine en el vertedero en lugar de ser procesada.',
                        ],
                    ],
                    [
                        'number'  => 3,
                        'title'   => 'Compostaje y residuos orgánicos',
                        'icon'    => 'bi-flower3',
                        'color'   => '#237a4f',
                        'content' => 'Los residuos orgánicos —restos de comida, cáscaras, poda de jardín— representan cerca del 40% de la basura doméstica, pero cuando terminan en un vertedero se descomponen sin oxígeno y generan metano, un gas de efecto invernadero mucho más potente que el CO₂. El compostaje transforma estos residuos en abono natural rico en nutrientes mediante descomposición aeróbica controlada. Compostar en la universidad o en el hogar cierra el ciclo de nutrientes y reduce significativamente el volumen de basura destinada a rellenos sanitarios.',
                        'key_points' => [
                            'Los residuos orgánicos representan cerca del 40% de la basura doméstica.',
                            'En un vertedero, la materia orgánica genera metano, un gas de efecto invernadero muy potente.',
                            'El compostaje casero puede reducir hasta un 30% el volumen total de basura de un hogar.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-basket2-fill',
                            'type'        => 'Mini compostera',
                            'description' => 'Investiga cómo armar una compostera casera simple (balde, lombricompostera o pila de jardín) y arma un instructivo con los pasos, materiales aceptados y no aceptados. Si es posible, inicia tu propia compostera y documenta su evolución durante 2 semanas.',
                        ],
                        'quiz' => [
                            'question'    => '¿Por qué es importante compostar los residuos orgánicos en lugar de enviarlos al vertedero?',
                            'options'     => [
                                'A' => 'Porque en el vertedero se descomponen sin oxígeno y generan metano, un potente gas de efecto invernadero.',
                                'B' => 'Porque ocupan más espacio que el plástico.',
                                'C' => 'Porque no se pueden mezclar con ningún otro residuo.',
                                'D' => 'Porque el compostaje elimina completamente la necesidad de agua en la agricultura.',
                            ],
                            'correct'     => 'A',
                            'explanation' => 'La descomposición anaeróbica en vertederos genera metano; el compostaje aeróbico evita esta emisión y produce abono útil para el suelo.',
                        ],
                    ],
                    [
                        'number'  => 4,
                        'title'   => 'Liderazgo ambiental en la comunidad universitaria',
                        'icon'    => 'bi-people-fill',
                        'color'   => '#155d3d',
                        'content' => 'El cambio de hábitos individuales se multiplica cuando se organiza en comunidad. Liderar una iniciativa ambiental en tu facultad puede ser tan simple como proponer puntos de reciclaje en tu sala de clases, organizar una jornada de limpieza, o crear un grupo estudiantil de sostenibilidad. Las iniciativas exitosas suelen partir de un diagnóstico claro del problema, involucrar a autoridades universitarias y medir el impacto con datos concretos para sostener el proyecto en el tiempo.',
                        'key_points' => [
                            'Las iniciativas ambientales estudiantiles tienen más impacto cuando involucran a las autoridades de la facultad.',
                            'Medir resultados (kg reciclados, participantes) ayuda a mantener y escalar un proyecto ambiental.',
                            'Un pequeño grupo comprometido puede movilizar a cientos de estudiantes con una buena estrategia de difusión.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-kanban-fill',
                            'type'        => 'Propuesta de iniciativa',
                            'description' => 'Diseña una propuesta breve (media página) para una iniciativa de gestión de residuos en tu facultad: problema identificado, acción propuesta, personas involucradas y una forma de medir el éxito. Preséntala a al menos un compañero o docente para recibir retroalimentación.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué elemento es clave para que una iniciativa ambiental estudiantil sea sostenible en el tiempo?',
                            'options'     => [
                                'A' => 'Mantenerla en secreto para evitar críticas.',
                                'B' => 'Medir su impacto con datos concretos y buscar apoyo institucional.',
                                'C' => 'Depender de una sola persona sin delegar tareas.',
                                'D' => 'Evitar involucrar a las autoridades de la facultad.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Medir resultados concretos y contar con respaldo institucional son factores clave para que una iniciativa ambiental perdure y crezca.',
                        ],
                    ],
                ],
                'evaluation' => [
                    'title'       => 'Evaluación: Reciclaje en el campus',
                    'description' => 'Responde para validar tus conocimientos sobre gestión de residuos.',
                    'questions'   => [
                        [
                            'number'   => 1,
                            'question' => '¿Cuál es el orden correcto de prioridad en la jerarquía de las 3R?',
                            'options'  => [
                                'A' => 'Reciclar → Reutilizar → Reducir',
                                'B' => 'Reducir → Reutilizar → Reciclar',
                                'C' => 'Reutilizar → Reciclar → Reducir',
                                'D' => 'Las 3R tienen la misma importancia.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'Reducir siempre es la acción más impactante pues evita la generación de residuos desde el inicio. Reutilizar extiende la vida útil y reciclar es el último recurso.',
                        ],
                        [
                            'number'   => 2,
                            'question' => '¿Por qué es importante la separación en origen de los residuos?',
                            'options'  => [
                                'A' => 'Porque facilita el trabajo de los camiones recolectores.',
                                'B' => 'Porque si los materiales se mezclan se contaminan y no pueden reciclarse.',
                                'C' => 'Solo importa separar plásticos del resto.',
                                'D' => 'No es relevante, las plantas de reciclaje separan automáticamente todo.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'La contaminación cruzada de materiales es la principal razón por la que los residuos que podrían reciclarse terminan en el vertedero. La separación en origen es imprescindible.',
                        ],
                        [
                            'number'   => 3,
                            'question' => '¿Dónde deben depositarse las pilas y baterías usadas?',
                            'options'  => [
                                'A' => 'En el basurero común junto con los residuos domésticos.',
                                'B' => 'En el contenedor de plásticos amarillo.',
                                'C' => 'En puntos limpios especializados o contenedores habilitados para residuos peligrosos.',
                                'D' => 'Pueden tirarse al alcantarillado si están completamente descargadas.',
                            ],
                            'correct'      => 'C',
                            'explanation'  => 'Las pilas contienen metales pesados tóxicos. Deben entregarse en puntos limpios o en los contenedores especiales disponibles en supermercados y tiendas de tecnología.',
                        ],
                        [
                            'number'   => 4,
                            'question' => '¿Qué gas de efecto invernadero se genera cuando los residuos orgánicos se descomponen en un vertedero?',
                            'options'  => [
                                'A' => 'Oxígeno.',
                                'B' => 'Metano.',
                                'C' => 'Hidrógeno.',
                                'D' => 'Nitrógeno.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'La descomposición anaeróbica de materia orgánica en los vertederos produce metano, un gas de efecto invernadero mucho más potente que el CO₂.',
                        ],
                        [
                            'number'   => 5,
                            'question' => '¿Qué factor ayuda más a que una iniciativa estudiantil de reciclaje se mantenga en el tiempo?',
                            'options'  => [
                                'A' => 'Medir su impacto y contar con apoyo institucional.',
                                'B' => 'Que dependa de una sola persona.',
                                'C' => 'Evitar difundirla entre los estudiantes.',
                                'D' => 'No establecer ninguna meta ni indicador.',
                            ],
                            'correct'      => 'A',
                            'explanation'  => 'Las iniciativas que miden resultados y logran respaldo institucional tienden a sostenerse y escalar con mayor facilidad.',
                        ],
                    ],
                ],
            ],
        ]);

        Course::create([
            'title'       => 'Agua: uso responsable y conservación en la vida universitaria',
            'description' => 'Comprende el valor del agua como recurso limitado, identifica tu huella hídrica y aplica hábitos concretos de ahorro en tu día a día universitario y doméstico.',
            'content'     => [
                'expected_result' => 'El estudiante comprenderá el ciclo y la escasez del agua, calculará su huella hídrica aproximada y adoptará hábitos de consumo responsable en el campus y su hogar.',
                'modules' => [
                    [
                        'number'  => 1,
                        'title'   => 'El ciclo del agua y la escasez hídrica',
                        'icon'    => 'bi-droplet-fill',
                        'color'   => '#0b6e91',
                        'content' => 'El agua dulce disponible para consumo humano representa menos del 1% del agua total del planeta. Aunque el ciclo hidrológico renueva este recurso de forma natural, la distribución geográfica desigual, el cambio climático y la sobreexplotación de acuíferos generan estrés hídrico en muchas regiones, incluidas zonas de Colombia en épocas de sequía. Entender que el agua potable es un recurso finito y vulnerable es el primer paso para valorarla y cuidarla.',
                        'key_points' => [
                            'Menos del 1% del agua del planeta es dulce y está disponible para el consumo humano.',
                            'El estrés hídrico afecta a más de 2.000 millones de personas en el mundo.',
                            'Colombia, pese a su riqueza hídrica, enfrenta escasez estacional en varias regiones por el fenómeno de El Niño.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-journal-text',
                            'type'        => 'Investigación local',
                            'description' => 'Investiga de dónde proviene el agua potable que llega a tu ciudad o municipio (cuenca, embalse o acuífero) y si ha enfrentado episodios de escasez en los últimos años. Redacta un resumen de media página con tus hallazgos.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué porcentaje del agua del planeta es dulce y está disponible para consumo humano?',
                            'options'     => [
                                'A' => 'Cerca del 50%.',
                                'B' => 'Menos del 1%.',
                                'C' => 'Aproximadamente el 25%.',
                                'D' => 'El 100%.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Menos del 1% del agua del planeta es dulce y accesible para el consumo humano; el resto es agua salada u océanos, o está congelada en glaciares.',
                        ],
                    ],
                    [
                        'number'  => 2,
                        'title'   => 'Hábitos de consumo responsable en el campus y el hogar',
                        'icon'    => 'bi-house-gear-fill',
                        'color'   => '#0d7fa8',
                        'content' => 'Pequeños cambios en la rutina diaria pueden reducir significativamente el consumo de agua: cerrar la llave mientras te enjabonas o cepillas los dientes, tomar duchas más cortas, reportar fugas visibles en baños y fuentes del campus, y reutilizar agua de lluvia o de enjuague para regar plantas. En espacios universitarios, reportar oportunamente una llave o inodoro que gotea puede evitar el desperdicio de miles de litros al mes.',
                        'key_points' => [
                            'Una llave goteando puede desperdiciar más de 3.000 litros de agua al año.',
                            'Cerrar la llave al cepillarte los dientes puede ahorrar hasta 12 litros por minuto.',
                            'Una ducha de 5 minutos consume aproximadamente la mitad de agua que un baño de tina.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-droplet-half',
                            'type'        => 'Reto de ahorro',
                            'description' => 'Durante una semana, aplica al menos 3 hábitos de ahorro de agua en tu rutina diaria (duchas cortas, cerrar la llave, reportar fugas). Lleva un registro simple y al final calcula aproximadamente cuántos litros crees haber ahorrado.',
                        ],
                        'quiz' => [
                            'question'    => '¿Cuál de las siguientes acciones ahorra más agua de forma directa?',
                            'options'     => [
                                'A' => 'Dejar la llave abierta mientras te cepillas los dientes.',
                                'B' => 'Cerrar la llave mientras te enjabonas o cepillas los dientes.',
                                'C' => 'Ignorar una fuga visible porque "es poca agua".',
                                'D' => 'Tomar baños de tina en lugar de duchas cortas.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Cerrar la llave mientras no se necesita el flujo de agua (al enjabonarse o cepillarse los dientes) puede ahorrar varios litros cada vez, sumando un gran impacto acumulado.',
                        ],
                    ],
                    [
                        'number'  => 3,
                        'title'   => 'Huella hídrica de los productos que consumimos',
                        'icon'    => 'bi-basket3-fill',
                        'color'   => '#106a89',
                        'content' => 'La huella hídrica mide el volumen total de agua dulce usado para producir un bien o servicio, incluyendo el agua "invisible" detrás de su fabricación. Producir una hamburguesa de carne de res puede requerir más de 2.400 litros de agua, mientras que una camiseta de algodón puede necesitar cerca de 2.700 litros considerando el cultivo, teñido y procesamiento. Reducir el consumo de productos con alta huella hídrica, optar por ropa de segunda mano y moderar el consumo de carne son formas indirectas pero poderosas de cuidar el agua.',
                        'key_points' => [
                            'Producir una hamburguesa de res puede requerir más de 2.400 litros de agua.',
                            'Una camiseta de algodón puede tener una huella hídrica cercana a los 2.700 litros.',
                            'Reducir el consumo de carne y ropa nueva disminuye indirectamente la huella hídrica personal.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-calculator-fill',
                            'type'        => 'Cálculo personal',
                            'description' => 'Elige 3 productos que consumes habitualmente (alimento, prenda de vestir, dispositivo) e investiga su huella hídrica aproximada. Compara los resultados y propone un cambio de hábito de consumo que podrías adoptar.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué mide el concepto de "huella hídrica" de un producto?',
                            'options'     => [
                                'A' => 'Solo el agua que se ve directamente al usar el producto.',
                                'B' => 'El volumen total de agua dulce usado en todo el proceso de producción del bien o servicio.',
                                'C' => 'La cantidad de agua que cabe en el empaque del producto.',
                                'D' => 'El costo económico del agua potable en una ciudad.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'La huella hídrica contempla toda el agua "invisible" usada a lo largo de la cadena de producción, no solo la que se percibe al usar el producto final.',
                        ],
                    ],
                ],
                'evaluation' => [
                    'title'       => 'Evaluación: Uso responsable del agua',
                    'description' => 'Responde para validar tus conocimientos sobre conservación del agua.',
                    'questions'   => [
                        [
                            'number'   => 1,
                            'question' => '¿Qué porcentaje del agua del planeta es dulce y está disponible para consumo humano?',
                            'options'  => [
                                'A' => 'Menos del 1%.',
                                'B' => 'Alrededor del 30%.',
                                'C' => 'Cerca del 60%.',
                                'D' => 'El 100%.',
                            ],
                            'correct'      => 'A',
                            'explanation'  => 'Solo una fracción mínima del agua del planeta es dulce y está disponible para consumo humano; el resto es agua salada o se encuentra congelada.',
                        ],
                        [
                            'number'   => 2,
                            'question' => '¿Qué efecto tiene una llave que gotea de forma constante?',
                            'options'  => [
                                'A' => 'Ningún efecto relevante en el consumo de agua.',
                                'B' => 'Puede desperdiciar miles de litros de agua al año.',
                                'C' => 'Reduce automáticamente la factura de agua.',
                                'D' => 'Solo afecta la presión del agua, no el consumo.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'Una fuga aparentemente pequeña puede acumular miles de litros de desperdicio de agua a lo largo de un año si no se repara a tiempo.',
                        ],
                        [
                            'number'   => 3,
                            'question' => '¿Qué es la huella hídrica de un producto?',
                            'options'  => [
                                'A' => 'El agua que se usa solo al momento de consumir el producto.',
                                'B' => 'El volumen total de agua dulce utilizado en todo su proceso de producción.',
                                'C' => 'La cantidad de agua que contiene físicamente el producto.',
                                'D' => 'Un impuesto que se paga por el uso de agua potable.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'La huella hídrica abarca toda el agua utilizada a lo largo de la cadena de producción de un bien, no solo la visible en su uso final.',
                        ],
                        [
                            'number'   => 4,
                            'question' => '¿Cuál de estas acciones contribuye más al ahorro responsable de agua?',
                            'options'  => [
                                'A' => 'Tomar duchas cortas y reportar fugas de agua en espacios comunes.',
                                'B' => 'Dejar corriendo el agua mientras se lava la loza.',
                                'C' => 'Regar el jardín en las horas de mayor calor del día.',
                                'D' => 'Ignorar fugas pequeñas porque no afectan el consumo total.',
                            ],
                            'correct'      => 'A',
                            'explanation'  => 'Duchas cortas y el reporte oportuno de fugas son hábitos simples con un impacto acumulado significativo en el ahorro de agua.',
                        ],
                    ],
                ],
            ],
        ]);

        Course::create([
            'title'       => 'Cambio climático y acción climática universitaria',
            'description' => 'Entiende las causas y consecuencias del cambio climático y descubre cómo la movilidad sostenible y el activismo estudiantil pueden marcar una diferencia real en tu universidad y comunidad.',
            'content'     => [
                'expected_result' => 'El estudiante comprenderá los fundamentos del cambio climático, evaluará opciones de movilidad sostenible y conocerá formas concretas de participar en acción climática dentro de la comunidad universitaria.',
                'modules' => [
                    [
                        'number'  => 1,
                        'title'   => 'Fundamentos del cambio climático y gases de efecto invernadero',
                        'icon'    => 'bi-thermometer-sun',
                        'color'   => '#b3560f',
                        'content' => 'El efecto invernadero es un fenómeno natural necesario para la vida, pero la quema de combustibles fósiles, la deforestación y ciertas prácticas agrícolas e industriales han incrementado drásticamente la concentración de gases como el CO₂ y el metano en la atmósfera, intensificando el calentamiento global. Desde la era preindustrial, la temperatura promedio del planeta ha aumentado más de 1.1°C, generando eventos climáticos extremos más frecuentes: sequías, inundaciones y olas de calor.',
                        'key_points' => [
                            'La temperatura global promedio ha aumentado más de 1.1°C desde la era preindustrial.',
                            'El CO₂ y el metano son los principales gases de efecto invernadero de origen humano.',
                            'La quema de combustibles fósiles es la mayor fuente de emisiones globales de CO₂.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-graph-up',
                            'type'        => 'Análisis de datos',
                            'description' => 'Busca datos oficiales (IDEAM, IPCC o similar) sobre la evolución de la temperatura promedio en Colombia o tu región en los últimos 30 años. Elabora un breve resumen con un gráfico simple o tabla que muestre la tendencia.',
                        ],
                        'quiz' => [
                            'question'    => '¿Cuál es la principal causa del aumento acelerado del efecto invernadero desde la era preindustrial?',
                            'options'     => [
                                'A' => 'La actividad volcánica natural.',
                                'B' => 'La quema de combustibles fósiles y la deforestación de origen humano.',
                                'C' => 'Los ciclos naturales del sol sin intervención humana.',
                                'D' => 'La rotación de las estaciones del año.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'La quema de combustibles fósiles y la deforestación son las principales fuentes de emisiones de gases de efecto invernadero causadas por la actividad humana.',
                        ],
                    ],
                    [
                        'number'  => 2,
                        'title'   => 'Movilidad sostenible en el campus',
                        'icon'    => 'bi-bicycle',
                        'color'   => '#c4630f',
                        'content' => 'El transporte es una de las principales fuentes de emisiones de CO₂ a nivel urbano. Optar por caminar, usar bicicleta, compartir vehículo (carpool) o priorizar el transporte público en los trayectos hacia la universidad reduce significativamente la huella de carbono individual. Muchas universidades, incluida la UDEC, promueven espacios para bicicletas y rutas peatonales seguras como parte de su compromiso con la sostenibilidad del campus.',
                        'key_points' => [
                            'El transporte representa una parte significativa de las emisiones de CO₂ en zonas urbanas.',
                            'Un viaje en bicicleta en lugar de auto particular puede evitar varios kilos de CO₂ por trayecto.',
                            'Compartir vehículo (carpool) reduce proporcionalmente las emisiones por persona transportada.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-signpost-2-fill',
                            'type'        => 'Reto de movilidad',
                            'description' => 'Durante una semana, sustituye al menos 2 trayectos que normalmente harías en vehículo particular por caminar, bicicleta, transporte público o carpool. Registra el cambio y reflexiona sobre la viabilidad de mantenerlo a largo plazo.',
                        ],
                        'quiz' => [
                            'question'    => '¿Por qué la movilidad sostenible ayuda a reducir el impacto del cambio climático?',
                            'options'     => [
                                'A' => 'Porque no tiene ninguna relación con las emisiones de CO₂.',
                                'B' => 'Porque reduce las emisiones de CO₂ asociadas al transporte individual motorizado.',
                                'C' => 'Porque aumenta el uso de combustibles fósiles de forma controlada.',
                                'D' => 'Porque solo afecta el tráfico, no el clima.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'Opciones como caminar, la bicicleta, el transporte público o el carpool reducen las emisiones de CO₂ por persona en comparación con el uso individual de vehículos motorizados.',
                        ],
                    ],
                    [
                        'number'  => 3,
                        'title'   => 'Activismo y voluntariado ambiental universitario',
                        'icon'    => 'bi-flag-fill',
                        'color'   => '#a84d0e',
                        'content' => 'Más allá de los hábitos individuales, la acción colectiva multiplica el impacto frente al cambio climático. Participar en grupos estudiantiles ambientales, jornadas de reforestación, campañas de sensibilización o veedurías sobre políticas ambientales locales son formas concretas de activismo al alcance de cualquier estudiante. La universidad, como espacio de formación de futuros profesionales, es un lugar clave para sembrar liderazgo climático.',
                        'key_points' => [
                            'La acción colectiva y organizada tiene mayor impacto que las acciones individuales aisladas.',
                            'Las jornadas de reforestación estudiantiles contribuyen a la captura de carbono a largo plazo.',
                            'Participar en veedurías ambientales fortalece la exigencia de políticas públicas responsables.',
                        ],
                        'activity' => [
                            'icon'        => 'bi-people-fill',
                            'type'        => 'Participación activa',
                            'description' => 'Identifica un grupo, colectivo o iniciativa ambiental estudiantil (existente o que podrías crear) en tu universidad. Describe en un párrafo cómo te gustaría participar y qué primer paso concreto darías este mes.',
                        ],
                        'quiz' => [
                            'question'    => '¿Qué caracteriza al activismo climático universitario efectivo?',
                            'options'     => [
                                'A' => 'Actuar siempre de forma individual y aislada.',
                                'B' => 'Organizarse colectivamente en grupos o campañas con objetivos claros.',
                                'C' => 'Evitar cualquier participación en política ambiental.',
                                'D' => 'Limitarse a hablar del tema sin tomar ninguna acción.',
                            ],
                            'correct'     => 'B',
                            'explanation' => 'La organización colectiva, con objetivos claros y acciones sostenidas en el tiempo, multiplica el impacto del activismo climático frente a acciones aisladas.',
                        ],
                    ],
                ],
                'evaluation' => [
                    'title'       => 'Evaluación: Cambio climático y acción universitaria',
                    'description' => 'Responde para validar tus conocimientos sobre cambio climático y acción climática.',
                    'questions'   => [
                        [
                            'number'   => 1,
                            'question' => '¿Qué gases son los principales responsables del efecto invernadero de origen humano?',
                            'options'  => [
                                'A' => 'Oxígeno y nitrógeno.',
                                'B' => 'CO₂ y metano.',
                                'C' => 'Helio y argón.',
                                'D' => 'Hidrógeno y ozono estratosférico.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'El dióxido de carbono (CO₂) y el metano son los principales gases de efecto invernadero generados por actividades humanas como la quema de combustibles fósiles.',
                        ],
                        [
                            'number'   => 2,
                            'question' => '¿Cuánto ha aumentado aproximadamente la temperatura global promedio desde la era preindustrial?',
                            'options'  => [
                                'A' => 'Más de 1.1°C.',
                                'B' => 'Se ha mantenido igual.',
                                'C' => 'Ha disminuido en 2°C.',
                                'D' => 'Más de 10°C.',
                            ],
                            'correct'      => 'A',
                            'explanation'  => 'La temperatura promedio global ha aumentado más de 1.1°C desde la era preindustrial, según reportes científicos internacionales.',
                        ],
                        [
                            'number'   => 3,
                            'question' => '¿Cuál de las siguientes es una opción de movilidad sostenible?',
                            'options'  => [
                                'A' => 'Usar siempre vehículo particular en solitario.',
                                'B' => 'Caminar, usar bicicleta, transporte público o compartir vehículo.',
                                'C' => 'Evitar cualquier desplazamiento hacia la universidad.',
                                'D' => 'Usar exclusivamente vuelos para trayectos cortos.',
                            ],
                            'correct'      => 'B',
                            'explanation'  => 'Caminar, la bicicleta, el transporte público y el carpool son alternativas que reducen las emisiones de CO₂ frente al uso individual de vehículos motorizados.',
                        ],
                        [
                            'number'   => 4,
                            'question' => '¿Qué hace más efectivo al activismo ambiental universitario?',
                            'options'  => [
                                'A' => 'La organización colectiva con objetivos claros y sostenidos en el tiempo.',
                                'B' => 'Actuar completamente solo y sin coordinación.',
                                'C' => 'Evitar cualquier tipo de campaña de sensibilización.',
                                'D' => 'No involucrar nunca a las autoridades universitarias.',
                            ],
                            'correct'      => 'A',
                            'explanation'  => 'La acción colectiva organizada, con metas claras, tiene un impacto mucho mayor y más sostenible que las acciones individuales aisladas.',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
