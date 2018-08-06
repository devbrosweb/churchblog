<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Post::create([
            'title' => 'Mi tribu',
            'slug' =>  'mi-tribu',
            'user_id' => 1,
            'image' => 'my-tribe_blog.jpg',
            'body' => 'Escuchamos frases como "mi tribu" o "mi gente" se usan mucho. ¿Eso significa tener una familia que se compone de los más cercanos a nosotros? ¿Qué es la familia? Busqué la palabra y la familia se define como: "la unidad básica en la sociedad que tradicionalmente consiste en dos padres criando a sus hijos".



Más importante aún, ¿cómo el mismo Jesús define a la familia? Radicalmente



Sara Zarr escribió un ejemplo perfecto de eso (tomado de Jesus Girls: True Tales of Growing Up Female and Evangelical):



"Hay una escena en el Evangelio de Mateo. Jesús está hablando con una multitud. Los temas son difíciles y complejos: el sábado, el diablo, los signos, los milagros. De la nada, alguien le dice a Jesús que su madre y sus hermanos están afuera esperando hablar con él. Jesús responde: \'¿Quién es mi madre y quiénes son mis hermanos?\' Señala a los discípulos y dice: "Aquí están mi madre y mis hermanos". Porque quien hace la voluntad de mi padre en el cielo es mi hermano, mi hermana y mi madre ". En el Evangelio de Lucas, Jesús no da golpes. "Si alguien viene a mí y no odia a su padre y a su madre, a su esposa e hijos, a sus hermanos y hermanas, sí, incluso a su propia vida, no puede ser mi discípulo".



En cualquier versión, el punto está hecho. Cuando sigues a Jesús, todo cambia, incluso, y quizás especialmente, los lazos más fuertes y naturales que puede tener una criatura ".



Guau.',
            'status' => 1,
            'approved' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        App\Post::create([
            'title' => '¿Navidad de verano ?',
            'slug' =>  'navidad-de-verano',
            'user_id' => 1,
            'image' => 'whatwedo.jpg',
            'body' => 'Hay un pánico inicial, reflexiones, preguntas y dudas en los momentos en que sentimos que Dios nos llama a algo que está más allá de nosotros. Esos momentos en los que pasos de fe gigantes están precedidos por grandes dudas.



He tenido momentos en los que mi duda fue simplemente demorar la desobediencia. Puedo pensar en incontables momentos en los que Dios me llamaba a perder peso y retrasé honrarlo con mi salud. Puedo pensar en esos momentos en los que sabía que Dios me quería en el ministerio, pero la fiesta era más atractiva, así que retrasé y dudé de que "Dios realmente quería que yo trabajara en una iglesia".',
                'status' => 1,
            'approved' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        App\Post::create([
            'title' => 'La comparación apesta ...',
            'slug' =>  'la-comparación-apesta',
            'user_id' => 2,
            'image' => 'summer_blog.jpg',
            'body' => 'Quiero decir que el título de esta publicación de blog es algo que sabemos, pero todos somos culpables de eso, ¿no? La comparación ocurre todo el tiempo. Las redes sociales no ayudan en absoluto. Las personas están diseñando toda su basura en redes sociales, por lo que, en comparación, creemos que nuestras vidas son grandiosas o que tenemos nuestras cosas juntas. Esto lleva a pasar por alto nuestras debilidades. Realmente no nos importa pensar en ellos. Por otro lado, vemos la vida "perfecta" de alguien y comenzamos a pensar que nuestra vida es terrible. Poco sabemos que tienen dificultades como todos tenemos dificultades.



Así es como se desarrolla la comparación en mi mundo; Voy a una conferencia y la gente pregunta cuántas personas hay en tu iglesia. Comparación . ¿Cuántos han sido bautizados o han comprometido sus vidas con Jesús? Comparación . ¿Cómo estás dando? Comparación .



"¿Qué aspecto tiene la comparación en tu vida?"



¿Cómo se ve la comparación en tu vida? ¿Qué produce en tu vida? ¿Cuáles son los resultados?



Mira este pasaje conmigo:



"En verdad, de verdad, te digo, cuando eras joven, te vestías y caminabas donde quisieras, pero cuando eres viejo, extiendes tus manos, y otro te viste y te lleva a donde lo haces No quiero ir. "(Esto dijo para mostrar por qué tipo de muerte él era para glorificar a Dios.) Y después de decir esto, le dijo:" Sígueme ". Pedro se volvió y vio al discípulo a quien Jesús amaba seguirlos, el que también se había recostado contra él durante la cena y había dicho: "Señor, ¿quién es el que te va a traicionar?" Cuando Pedro lo vio, le dijo a Jesús: "Señor, ¿qué hay de este hombre?" Jesús le dijo: "Si es mi voluntad que permanezca hasta que yo venga, ¿qué es eso para ti? ¡Sígueme! "Entonces se difundió entre los hermanos que este discípulo no iba a morir;



Este pensamiento parte de algo que Tim Lucas, de Liquid Church, dijo en una conferencia. Como dije, este es un lugar donde la comparación entre mis pares ocurre rutinariamente.



En el pasaje, Pedro acaba de tener un momento realmente poderoso con nuestro Salvador resucitado, Jesucristo. Jesús sigue preguntando sobre su amor. ¿Tienes un profundo amor por mí o simplemente un tipo de amistad amiga? ¿Me amas? A través de este cuestionamiento, Jesús conduce a Pedro a seguirlo fuera de un lugar de amor. Diciendo, Peter, si me amas, ¡dame todo, dame tu vida! Jesús le confirma que él (Pedro) algún día morirá en su devoción por el Señor.



Ponte en las sandalias de Pedro. Tu amor ha sido cuestionado (con razón, negaste al Señor durante su juicio). Estás cara a cara con el Señor resucitado que te está impulsando a darle todo. Estás allí con tus compañeros. Te acaban de decir que algún día morirás por tu fe. Debe ser incómodo. ¿Es por un estado de incomodidad que impulsa la comparación?



¿No es eso lo que hace Peter? ¿No es así como responde? "¿Qué hay de él?" Preguntará Peter. Comparación.



Nosotros hacemos eso. En un lugar de incomodidad, miramos a los demás. Comenzamos a comparar. Comenzamos a preguntar y cuestionar. ¿Eso es saludable? En esos momentos Jesús nos mira directamente diciendo lo mismo, "¿Qué es eso para ti?"



En mis momentos de comparación, ¿sabes cómo respondería a "¿Qué es para ti?" Silencio.



Jesús, tienes razón. ¿Qué es para mí? No tengo una respuesta. Esto se trata de nosotros y tu. Seguirlo no es seguir a otro. Me has llamado a una carrera que has diseñado específicamente para mí. Necesito correr mi carrera, no la carrera de otro. Dios me perdone por el pecado de la comparación no saludable.



"Si la comparación te aleja de Jesús mientras cuestionas tu relación con Él, no es saludable". 



Si la comparación te aleja de Jesús al cuestionar tu relación con Él, no es saludable. Las cosas no saludables deben ser eliminadas. Llegar a la poda (cortando lo no saludable).



Mantenga su enfoque en Jesús. Nunca te equivocarás con eso. Es saludable. Corre con eso. Un enfoque en Jesús impulsa mi necesidad de Jesús.',
            'status' => 1,
            'approved' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
