<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++)
        {
            $post = Post::query()->firstOrCreate([
                'active' => rand(0, 1),
                'youtube_url' => fake()->url,
            ]);

            $post->postText()->create([
                'post_id' => $post->id,
                'title' => [
                    'hy' => 'Որքա՞ն էներգիա է արտադրում արևային մարտկոցը',
                    'en' => 'How much energy does a solar panel generate?',
                    'ru' => 'Сколько энергии генерирует солнечная панель?',
                ],
                'short_description' => [
                    'hy' => 'Ձեր համակարգի ճշգրիտ ելքային հզորությունը կախված կլինի ձեր օգտագործած ֆոտոգալվանային (PV) արևային վահանակների տեսակից և արտաքին գործոններից, ինչպիսիք են արևի լույսը և շրջակա միջավայրի ջերմաստիճանը',
                    'en' => 'The exact power output of your system will depend on the type of photovoltaic (PV) solar panels you use and external factors like sunshine and ambient temperature.',
                    'ru' => 'Точная выходная мощность вашей системы будет зависеть от типа используемых вами фотоэлектрических (PV) солнечных панелей и внешних факторов, таких как солнечный свет и температура окружающей среды.',
                ],
                'description' => [
                    'hy' => 'Արևային մարտկոցների հզորությունը որոշվում է լաբորատոր պայմաններում, սակայն այն տեղադրվելուց հետո անընդհատ փոխվում է: Ձեր համակարգի ճշգրիտ ելքային հզորությունը կախված կլինի ձեր օգտագործած ֆոտոգալվանային (PV) արևային վահանակների տեսակից և արտաքին գործոններից, ինչպիսիք են արևի լույսը և շրջակա միջավայրի ջերմաստիճանը: Միջին արևային մարտկոցն ունի 250-ից 400 վտ (Վտ)  հզորություն և օրական արտադրում է մոտ 1,5 կվտ/ժամ (կՎտժ) էներգիա: Շատ տներ կարող են բավարարել էներգիայի կարիքները՝ օգտագործելով 20 արևային մարտկոցներ, որոնք սովորաբար ունեն վեցից ութ կիլովատ (կՎտ) տեղադրված համակարգի հզորություն: Արևային էներգիան վերածվում է ջերմային կամ էլեկտրական էներգիայի: Արևային էներգիան վերականգնվող էներգիայի ամենամաքուր և առատ աղբյուրն է, և ԱՄՆ-ն ունի աշխարհի ամենահարուստ արևային ռեսուրսներից մի քանիսը: Արևային տեխնոլոգիաները կարող են օգտագործել այս էներգիան տարբեր նպատակների համար՝ ներառյալ էլեկտրաէներգիա արտադրելը, լուսավորությունը կամ հարմարավետ ներքին միջավայրը և ջուրը տաքացնելը կենցաղային, առևտրային կամ արդյունաբերական օգտագործման համար: Էլեկտրաէներգիայի ծախսերի կրճատումից մինչև էներգիայի կախվածությունը և ածխածնի հետքը վերացնելը, ավելի կայուն ապագայում ներդրումներ կատարելը նույնքան լավ պատճառ է արևային էներգիայով սկսելու համար: Այնուամենայնիվ, արևային մարտկոցների տարբեր չափերի, կազմի և կշռման գործոնների առկայության դեպքում դժվար է պարզել, թե քանի արևային մարտկոց է անհրաժեշտ ձեր ROI-ն առավելագույնի հասցնելու համար: Սա մեզ ստիպում է մտածել՝ գիտե՞ք, թե քանի արևային մարտկոց է ձեզ անհրաժեշտ: Արևային մարտկոցների երեք հիմնական չափեր կան՝ 60-բջջային, 72-բջջային և 96-բջջային: Առևտրային և բնակելի արևային մարտկոցների համար 60 և 72 բջջային արևային մարտկոցների չափերն ամենից հաճախ օգտագործվում են, քանի որ 96 խցերը չափում են 17,5 քառակուսի ոտնաչափ, ինչը կարող է դժվարին տեղավորել ձեր տանիքին: Ընկերությունը կարող է օգնել ձեզ նաև արևային համակարգի ֆինանսավորման  հարցում, ընդ որում  վճարումը կարող եք կատարել ինչպես կանխիկ, այնպես էլ ապառիկ եղանակով։ Արևային մարտկոցները կարող են շահավետ ներդրում լինել՝ կախված ձեր էլեկտրաէներգիայի գներից, էներգիայի պահանջարկից, գտնվելու վայրից և էկոլոգիապես մաքուր ապրելու ցանկությունից: Պատրա՞ստ եք ներդրումներ կատարել ավելի մաքուր ապագայի համար: Այսօր խոսեք մեր արևային տեղադրման փորձագետներից մեկի հետ և ստացեք ձեզ անհրաժեշտ պատասխանները առանց դժվարության:',

                    'en' => 'The capacity of solar panels is determined in the laboratory, but it is constantly changing after installation. The exact power output of your system will depend on the type of photovoltaic (PV) solar panels you use and external factors such as sunlight and ambient temperature. The average solar panel has a power of 250 to 400 watts (W) and produces about 1.5 kilowatt hours (kWh) of energy per day. Many homes can meet their energy needs using 20 solar panels, typically with an installed system capacity of six to eight kilowatts (kW). Solar energy is converted into thermal or electrical energy. Solar energy is the cleanest and most abundant source of renewable energy, and the United States has some of the richest solar resources in the world. Solar technologies can use this energy for a variety of purposes, including generating electricity, lighting or heating indoor environments and water for domestic, commercial or industrial use. From reducing electricity costs to eliminating energy dependency and carbon footprint, investing in a more sustainable future is as good a reason as any to go solar. However, with different solar panel sizes, compositions, and weighting factors, it can be difficult to determine how many solar panels are needed to maximize your ROI. This leads us to wonder, do you know how many solar panels you need? There are three main sizes of solar cells: 60-cell, 72-cell, and 96-cell. For commercial and residential solar panels, the 60 and 72 cell solar panel sizes are most commonly used because 96 cells measure 17.5 square feet, which can be difficult to fit on your roof. The company can also help you with the financing of the solar system, and you can make the payment either in cash or on credit. Solar panels can be a profitable investment depending on your electricity rates, energy demand, location and desire to live eco-friendly. Are you ready to invest in a cleaner future? Talk to one of our solar installation experts today and get the answers you need without the hassle.',

                    'ru' => 'Мощность солнечных панелей определяется в лаборатории, но после установки она постоянно меняется. Точная выходная мощность вашей системы будет зависеть от типа используемых вами фотоэлектрических (PV) солнечных панелей и внешних факторов, таких как солнечный свет и температура окружающей среды. Средняя солнечная панель имеет мощность от 250 до 400 Вт (Вт) и производит около 1,5 киловатт-часов (кВтч) энергии в день. Многие дома могут удовлетворить свои потребности в энергии, используя 20 солнечных панелей, обычно с установленной мощностью системы от шести до восьми киловатт (кВт). Солнечная энергия преобразуется в тепловую или электрическую энергию. Солнечная энергия — самый чистый и богатый источник возобновляемой энергии, а Соединенные Штаты обладают одними из самых богатых солнечных ресурсов в мире. Солнечные технологии могут использовать эту энергию для различных целей, включая выработку электроэнергии, освещение или обогрев помещений, а также воду для бытового, коммерческого или промышленного использования. Инвестиции в более устойчивое будущее — от снижения затрат на электроэнергию до устранения энергетической зависимости и выбросов углекислого газа — являются такой же веской причиной перехода на солнечную энергию, как и любая другая. Однако из-за различных размеров, состава и весовых коэффициентов солнечных панелей может быть сложно определить, сколько солнечных панелей необходимо для максимизации окупаемости инвестиций. Это заставляет нас задуматься: знаете ли вы, сколько солнечных панелей вам нужно? Существует три основных размера солнечных элементов: 60-элементный, 72-элементный и 96-элементный. Для коммерческих и жилых солнечных панелей чаще всего используются солнечные панели размером 60 и 72 элемента, поскольку площадь 96 ячеек составляет 17,5 квадратных футов, что может быть сложно разместить на вашей крыше. Компания также может помочь вам с финансированием солнечной системы, причем оплату вы можете произвести как наличными, так и в кредит. Солнечные панели могут быть выгодной инвестицией в зависимости от ваших тарифов на электроэнергию, спроса на энергию, местоположения и желания жить экологично. Готовы ли вы инвестировать в более чистое будущее? Поговорите сегодня с одним из наших экспертов по установке солнечных батарей и получите необходимые ответы без хлопот.',
                ],
            ]);
        }
    }
}
