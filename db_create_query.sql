CREATE DATABASE `timeline`;
CREATE TABLE `timeline`.`categories` (
                                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         `updated_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`id`),
                                         UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`categories` VALUES (1,'Dramat','Zapożyczone z literatury określenie filmów, których nie da się zakwalifikować do określonych gatunków filmowych. Kwalifikowanie pewnych filmów jako „dramaty” wynika z braku konwencji charakteryzujących kino gatunkowe, a także z właściwości artystycznych danego dzieła.  Tradycyjnie dramaty filmowe dzielą się na filmy obyczajowe, społeczne (w tym dramaty sądowe) i psychologiczne. Formą pochodną dramatu jest także melodramat. Określenie „dramat” bywa używane także w połączeniu z nazwą gatunku (na przykład dramat wojenny), co wcale jednak nie musi zmieniać wymowy i dramaturgii danego filmu.','#8b4646','2023-11-05 19:25:52','2023-11-05 19:25:52'),(2,'Western','gatunek filmu fabularnego, powieści awanturniczej albo sztuki scenicznej, obejmujący utwory, których akcja rozgrywa się w okresie kolonizacji i stabilizowania się życia na terenach zachodnich stanów USA, zwanych Dzikim Zachodem. Często miejsce akcji nie jest konkretnym stanem, ale terytorium zorganizowanym – zalążkiem przyszłego stanu. Western jest charakterystyczną formą amerykańską, chociaż był uprawiany również przez twórców rodem z Europy.','#d2acac','2023-11-05 19:26:36','2023-11-05 19:26:36'),(3,'Przygodowy','Film o akcji skonstruowanej z ciągu przygód protagonisty, charakteryzujący się szybkim tempem akcji, brawurowymi rozwiązaniami fabularnymi oraz licznymi przeszkodami pokonywanymi przez bohaterów. Schemat filmów przygodowych opiera się na licznych scenach pościgów, ucieczek, eksplozji oraz niebezpiecznych dla protagonisty wydarzeniach.','#3a97df','2023-11-05 19:27:12','2023-11-05 19:27:12'),(4,'Fantasy','Gatunek filmowy obejmujący obrazy filmowe, w fabule, których występują motywy związane z magią, nadprzyrodzonością, mitologią, wymyślonym folklorem czy też istnieniem fantastycznych światów','#e2c403','2023-11-05 19:27:38','2023-11-05 19:27:38'),(6,'Animowany','Film, w którym ujęcia są realizowane metodą zdjęć poklatkowych rejestrujących pojedyncze kadry z fazami akcji filmowej, w przeciwieństwie do filmu fabularnego (aktorskiego) i dokumentalnego, gdzie ujęcia są rejestrowane w kamerze w sposób ciągły. Film realizowany jedną z technik animacyjnych wykreowanych w historii artystycznej animacji, wśród których są: rysunkowa, lalkowa (stop-motion), wycinankowa, plastelinowa, pikselacja, pinscreen, poklatkowe łączenie obrazów z wielu kamer, rysowanie odręczne na klatkach filmu, techniki specjalne wykonywane metodą klatka po klatce.','#19e50b','2023-11-05 19:28:38','2023-11-05 19:28:38'),(8,'Familijny','Gatunek filmowy, który zawiera treści dotyczące świata dzieci lub odnosi się do nich w kontekście domu i rodziny. Film familijny jako gatunek skierowany jest przede wszystkim do dzieci, jak również dla szerokiej publiczności[1][2]. Filmy familijne realizowane są według zróżnicowanej formy gatunku filmowego (m.in. fantasy, animacja, realizm, wojenne, muzyczne oraz jako adaptacje literatury).','#ea0606','2023-11-05 19:29:35','2023-11-05 19:29:35'),(9,'Komedia','Film przedstawiający sytuacje i postacie wywołujące u widzów efekt komiczny. Komedia istnieje od zarania dziejów sztuki filmowej – za pierwszy film komediowy uchodzi Polewacz polany (1895) autorstwa braci Lumière. Komedii nie cechuje określona konwencja fabularna, ale efekt, jaki wywołują one w widzu.','#e907e1','2023-11-05 19:30:12','2023-11-05 19:30:12'),(10,'Sci-fi','Gatunek literacki, filmowy oraz gier komputerowych o fabule osnutej na przewidywanych osiągnięciach nauki i techniki oraz ukazującej ich wpływ na życie jednostki lub społeczeństwa[1][2]. W świecie przedstawionym utworów nie występują elementy cudowności, a także przestrzega się zasad prawdopodobieństwa[1]. Razem z fantasy i horrorem, fantastyka naukowa zaliczana jest do fantastyki.','#0fe6bb','2023-11-05 19:31:05','2023-11-05 19:31:05'),(11,'Akcja','film sensacyjny, którego głównym zadaniem jest dostarczanie rozrywki widzom poprzez pokazywanie pościgów samochodowych, strzelanin, bijatyk i innych scen kaskaderskich o dużym ładunku napięcia i emocji. Film akcji jest często łączony z innymi gatunkami takimi jak: fantastyka naukowa (Terminator, Matrix), horror (Blade: Wieczny łowca) czy komedia (Zabójcza broń).','#1a1a1a','2023-11-05 19:31:29','2023-11-05 19:31:29');
CREATE TABLE `timeline`.`failed_jobs` (
                                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                          `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `timeline`.`migrations` (
                                         `id` int unsigned NOT NULL AUTO_INCREMENT,
                                         `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `batch` int NOT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_10_28_091925_add_categories_table',1),(6,'2023_10_28_093910_add_timeline_events_table',1),(7,'2023_10_28_093920_add_timeline_event_categories_table',1),(8,'2023_11_04_105346_add_user_extra_fields',1),(9,'2023_11_04_110709_add_user_settings_table',1),(10,'2023_11_05_190123_change_varchar_sizes',1);
CREATE TABLE `timeline`.`password_reset_tokens` (
                                                    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                    `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                    `created_at` timestamp NULL DEFAULT NULL,
                                                    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `timeline`.`personal_access_tokens` (
                                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                                     `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                     `tokenable_id` bigint unsigned NOT NULL,
                                                     `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                     `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                                     `abilities` text COLLATE utf8mb4_unicode_ci,
                                                     `last_used_at` timestamp NULL DEFAULT NULL,
                                                     `expires_at` timestamp NULL DEFAULT NULL,
                                                     `created_at` timestamp NULL DEFAULT NULL,
                                                     `updated_at` timestamp NULL DEFAULT NULL,
                                                     PRIMARY KEY (`id`),
                                                     UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                                     KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE `timeline`.`users` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `email_verified_at` timestamp NULL DEFAULT NULL,
                                    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`users` VALUES (1,'Łukasz','bossgame32@gmail.com',NULL,'$2y$10$ZfFa7.4SPHuPEXZgBQSmHOO4r52i7sqV0qcnif9UZwpSgX1S33nyC',NULL,'2023-11-05 19:24:44','2023-11-05 20:45:32',NULL,NULL,NULL,NULL,'images/profile/1.png');
CREATE TABLE `timeline`.`user_settings` (
                                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                            `user_id` bigint unsigned NOT NULL,
                                            `notification_days_before` int NOT NULL,
                                            `notification_days_after` int NOT NULL,
                                            `created_at` timestamp NULL DEFAULT NULL,
                                            `updated_at` timestamp NULL DEFAULT NULL,
                                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`user_settings` VALUES (1,2,1,7,'2023-11-05 19:59:38','2023-11-05 19:59:38');
CREATE TABLE `timeline`.`timeline_events` (
                                              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                              `user_id` bigint unsigned NOT NULL,
                                              `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                              `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
                                              `start_date` timestamp NOT NULL,
                                              `end_date` timestamp NULL DEFAULT NULL,
                                              `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                              `is_public` tinyint(1) NOT NULL,
                                              `created_at` timestamp NULL DEFAULT NULL,
                                              `updated_at` timestamp NULL DEFAULT NULL,
                                              PRIMARY KEY (`id`),
                                              KEY `timeline_events_user_id_foreign` (`user_id`),
                                              CONSTRAINT `timeline_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `timeline`.`users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`timeline_events` VALUES (1,1,'Dziwne ścieżki życia','Silva (Pedro Pascal) wyrusza konno przez pustynię w odwiedziny do znajomego szeryfa Jake\'a (Ethan Hawke). Dwadzieścia pięć lat wcześniej zarówno szeryf, jak i Silva pracowali razem jako najemnicy. Silva odwiedza go, aby powspominać stare dzieje i tego wieczoru świętują swoje spotkanie. Po wspólnie spędzonej  nocy Jake zdaje sobie sprawę, że powodem odwiedzin Silvy nie są wspomnienia  ich starej znajomości. To zupełnie inny powód, który poznamy w kinach17 listopada 2023r.','2023-11-17 00:00:00','2023-11-30 00:00:00','images/event/1.webp',1,'2023-11-05 19:32:18','2023-11-05 19:32:44'),(2,1,'Kajtek Czarodziej','Kajtek, nastoletni chłopiec o wyjątkowo krnąbrnym usposobieniu, wychowuje się z tatą i babcią. Klasowy psotnik pewnego dnia odkrywa w sobie nadnaturalne umiejętności. Czarodziejskie moce przejmują kontrolę nad życiem Kajtka, który od teraz rozprawia się zarówno z nielubianymi nauczycielami, jak i całą szkolną społecznością, zdobywając sympatię i sławę wśród rówieśników. Sytuacja zaczyna się komplikować, gdy o obdarzonego magicznymi zdolnościami chłopca zaczynają rywalizować siły dobra i zła. W którą stronę pójdzie młody czarodziej?','2023-11-03 00:00:00','2023-11-20 00:00:00','images/event/2.webp',1,'2023-11-05 19:35:33','2023-11-05 21:25:02'),(3,1,'Życzenie','\"Życzenie\" - animowana komedia muzyczna od Walt Disney Animation Studios zaprasza widzów do magicznego królestwa Rosas, którego władca posiada moc spełniania życzeń. Młoda dziewczyna Asha wypowiada życzenie tak potężne, że odpowiada na nie kosmiczna siła - gwiazdka o ogromnej mocy. Asha, jej wierny towarzysz koziołek Valentino i gwiazdka wspólnie stawiają czoła najgroźniejszemu wrogowi - władcy Rosas, królowi Magnifiko. Czy ocalą swoją społeczność i udowodnią, że kiedy wola jednego odważnego człowieka łączy się z magią gwiazd mogą wydarzyć się cudowne rzeczy.','2023-11-22 00:00:00','2023-12-06 00:00:00','images/event/3.webp',1,'2023-11-05 19:36:48','2023-11-05 19:36:58'),(4,1,'Napoleon','Napoleon to przepełniony widowiskową akcją epicki obraz, który szczegółowo opisuje wzlot upadek kultowego francuskiego cesarza Napoleona Bonaparte, granego przez zdobywcę Oscara® Joaquina Phoenixa. Wyreżyserowany przez legendarnego reżysera Ridleya Scotta,  film przedstawia nieustępliwą podróż Bonapartego do władzy przez pryzmat jego  uzależniającego, niestabilnego związku z jego jedyną prawdziwą miłością, Józefiną, ukazując  jego wizjonerską taktykę wojskową i polityczną w połączeniu z jednymi z najbardziej  dynamicznych sekwencji bitew, jakie kiedykolwiek nakręcono.','2023-11-24 00:00:00','2023-12-17 00:00:00','images/event/4.webp',1,'2023-11-05 19:38:33','2023-11-05 19:38:44'),(5,1,'Trolle 3','Po dwóch filmach prawdziwej przyjaźni i flirtowania, Poppy i Mruk są teraz oficjalnie parą! Poppy odkrywa, że Mruk ma sekretną przeszłość. Był kiedyś częścią fenomenalnego boysbandu, BroZone, wraz ze swoimi czterema braćmi: Floydem, Johnem Dory, Sprucem i Clayem. BroZone rozpadł się, a Mruk od tamtej pory nie widział swoich braci. Mruk i Poppy wyruszają w pełną emocji podróż, aby zjednoczyć braci.','2023-12-01 00:00:00','2023-12-31 00:00:00','images/event/5.webp',1,'2023-11-05 19:39:30','2023-11-05 19:39:42'),(6,1,'How to have sex','Trzy nastolatki wyruszają na wakacje pełne alkoholu, klubów i seksu.','2023-12-24 00:00:00','2024-01-11 00:00:00','images/event/6.webp',1,'2023-11-05 19:40:22','2023-11-05 19:40:36'),(7,1,'Diuna: część druga','Książę Paul Atryda przyjmuje przydomek Muad\'Dib i rozpoczyna duchowo-fizyczną podróż, by stać się przepowiedzianym w proroctwie wyzwolicielem ludu Diuny.','2024-03-15 00:00:00','2024-04-15 00:00:00','images/event/7.webp',1,'2023-11-05 19:41:29','2023-11-05 19:41:38'),(8,1,'Aquaman i zaginione królestwo','Jeden król poprowadzi wszystkich. AQUAMAN I ZAGINIONE KRÓLESTWO w kinach od 21 grudnia #Aquaman Reżyser James Wan i sam Aquaman - Jason Momoa – oraz Patrick Wilson, Amber Heard, Yahya Abdul-Mateen II i Nicole Kidman powracają w sequelu najbardziej kasowego filmu DC wszech czasów pt. Aquaman i zaginione królestwo. Poprzednio Czarna Manta nie zdołał pokonać Aquamana. Wciąż jednak pragnie pomścić śmierć ojca i dlatego nie cofnie się przed niczym, żeby rozprawić się z Aquamanem raz na zawsze.','2023-12-21 00:00:00','2024-01-17 00:00:00','images/event/8.webp',1,'2023-11-05 19:42:54','2023-11-05 19:43:32'),(9,1,'Inspektor Pająk','Wsiadając na pokład luksusowego samolotu Inspektor Pająk spodziewał się odpoczynku w miłym towarzystwie. Niestety wśród pasażerów znajduje się tajemniczy złoczyńca. To za jego sprawą w niepokojących okolicznościach znikają kolejni podróżni. Najlepszy śledczy na świecie wkracza do akcji i rozpoczyna śledztwo. Podejrzanych jest wielu, a tropy plączą się jak nitki pajęczej sieci. Wszystko wskazuje na to, że ktoś wciąga Inspektora w niebezpieczną intrygę, by wyrównać z nim dawne rachunki. Trudno będzie mu odnaleźć czarny charakter wśród tak kolorowej gromady, ale na jego szczęście, owady zostawiają ślady!','2023-11-10 00:00:00','2023-11-30 00:00:00','images/event/9.webp',1,'2023-11-05 19:44:13','2023-11-05 19:44:21');
CREATE TABLE `timeline`.`timeline_event_categories` (
                                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                             `timeline_event_id` bigint unsigned NOT NULL,
                                             `category_id` bigint unsigned NOT NULL,
                                             `created_at` timestamp NULL DEFAULT NULL,
                                             `updated_at` timestamp NULL DEFAULT NULL,
                                             PRIMARY KEY (`id`),
                                             KEY `timeline_event_categories_timeline_event_id_foreign` (`timeline_event_id`),
                                             KEY `timeline_event_categories_category_id_foreign` (`category_id`),
                                             CONSTRAINT `timeline_event_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `timeline`.`categories` (`id`) ON DELETE CASCADE,
                                             CONSTRAINT `timeline_event_categories_timeline_event_id_foreign` FOREIGN KEY (`timeline_event_id`) REFERENCES `timeline`.`timeline_events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `timeline`.`timeline_event_categories` VALUES (1,1,1,'2023-11-05 19:32:18','2023-11-05 19:32:18'),(2,1,2,'2023-11-05 19:32:18','2023-11-05 19:32:18'),(3,2,3,'2023-11-05 19:35:33','2023-11-05 19:35:33'),(4,2,4,'2023-11-05 19:35:33','2023-11-05 19:35:33'),(5,3,3,'2023-11-05 19:36:48','2023-11-05 19:36:48'),(6,3,6,'2023-11-05 19:36:48','2023-11-05 19:36:48'),(7,3,8,'2023-11-05 19:36:48','2023-11-05 19:36:48'),(8,4,1,'2023-11-05 19:38:33','2023-11-05 19:38:33'),(9,5,6,'2023-11-05 19:39:30','2023-11-05 19:39:30'),(10,5,8,'2023-11-05 19:39:30','2023-11-05 19:39:30'),(11,5,9,'2023-11-05 19:39:30','2023-11-05 19:39:30'),(12,6,1,'2023-11-05 19:40:22','2023-11-05 19:40:22'),(13,7,10,'2023-11-05 19:41:29','2023-11-05 19:41:29'),(14,8,10,'2023-11-05 19:42:54','2023-11-05 19:42:54'),(15,8,11,'2023-11-05 19:42:54','2023-11-05 19:42:54'),(16,9,6,'2023-11-05 19:44:13','2023-11-05 19:44:13'),(17,9,8,'2023-11-05 19:44:13','2023-11-05 19:44:13');
