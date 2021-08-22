-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Nov 29. 18:34
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `otp_bank_liga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `csapatok`
--

CREATE TABLE `csapatok` (
  `Név` text NOT NULL,
  `Vezető edző` text NOT NULL,
  `Kapusok` int(2) NOT NULL,
  `Védők` int(2) NOT NULL,
  `Középpályások` int(2) NOT NULL,
  `Támadók` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `csapatok`
--

INSERT INTO `csapatok` (`Név`, `Vezető edző`, `Kapusok`, `Védők`, `Középpályások`, `Támadók`) VALUES
('Budafok', '-', 2, 6, 9, 8),
('Diósgyőri VTK', 'Feczkó Tamás', 2, 6, 7, 4),
('Ferencvárosi TC', 'Rebrov Szerhij', 1, 6, 12, 5),
('Honvéd FC', 'Bódog Tamás', 1, 6, 11, 8),
('Kisvárda', 'Supka Attila', 2, 5, 10, 6),
('Mezőkövesd', 'Kuttor Attila, Pintér Attila', 1, 6, 10, 4),
('MOL Fehérvár FC', 'Márton Gábor', 2, 5, 7, 5),
('MTK Budapest', 'Boris Michael', 1, 5, 10, 7),
('Paks', 'Bognár György, Osztermájer Gábor', 2, 5, 12, 6),
('Puskás Akadémia', 'Hornyák Zsolt', 2, 7, 10, 6),
('Újpest', 'Rogan Predrag', 3, 5, 9, 8),
('Zalaegerszeg', 'Boér Gábor', 1, 7, 5, 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jatekosok`
--

CREATE TABLE `jatekosok` (
  `Jétékos neve` text NOT NULL,
  `Személyi szám` int(20) NOT NULL,
  `Csapat` text NOT NULL,
  `Poszt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `jatekosok`
--

INSERT INTO `jatekosok` (`Jétékos neve`, `Személyi szám`, `Csapat`, `Poszt`) VALUES
('Ryabenko Danylo', 1, 'Mezőkövesd', 'Kapus'),
('Eperjesi Gábor', 3, 'Mezőkövesd', 'Védő'),
('Farkas Dániel', 4, 'Mezőkövesd', 'Védő'),
('Guzmics Richárd', 5, 'Mezőkövesd', 'Védő'),
('Jagodics Márk', 6, 'Mezőkövesd', 'Védő'),
('Katanec Matija', 7, 'Mezőkövesd', 'Védő'),
('Lakvekheliani Luka', 8, 'Mezőkövesd', 'Védő'),
('Barczi Dávid', 11, 'Mezőkövesd', 'Középpályás'),
('Cseri Tamás', 13, 'Mezőkövesd', 'Középpályás'),
('Karnitskiy Aleksandr', 14, 'Mezőkövesd', 'Középpályás'),
('Martic Manuel', 15, 'Mezőkövesd', 'Középpályás'),
('Meskhi Mikhail', 16, 'Mezőkövesd', 'Középpályás'),
('Nagy Dániel', 17, 'Mezőkövesd', 'Középpályás'),
('Szeles Tamás', 18, 'Mezőkövesd', 'Középpályás'),
('Vadnai Dániel', 19, 'Mezőkövesd', 'Középpályás'),
('Vajda Sándor', 20, 'Mezőkövesd', 'Középpályás'),
('Vutov Antonio', 21, 'Mezőkövesd', 'Középpályás'),
('Berecz Zsombor', 22, 'Mezőkövesd', 'Támadó'),
('Boryachuk Andrii', 23, 'Mezőkövesd', 'Támadó'),
('Jurina Marin', 24, 'Mezőkövesd', 'Támadó'),
('Serderov Serder', 25, 'Mezőkövesd', 'Támadó'),
('Tujvel Tomas', 26, 'Honvéd FC', 'Kapus'),
('Aliji Naser', 27, 'Honvéd FC', 'Védő'),
('Baráth Botond', 28, 'Honvéd FC', 'Védő'),
('Craciun Artur', 29, 'Honvéd FC', 'Védő'),
('Lovric Ivan', 30, 'Honvéd FC', 'Védő'),
('Szabó Alex', 31, 'Honvéd FC', 'Védő'),
('Tamás Krisztián', 32, 'Honvéd FC', 'Védő'),
('Batik Bence', 33, 'Honvéd FC', 'Középpályás'),
('Bocskay Bertalan', 34, 'Honvéd FC', 'Középpályás'),
('Gazdag Dániel', 35, 'Honvéd FC', 'Középpályás'),
('Hidi Patrik', 36, 'Honvéd FC', 'Középpályás'),
('Kamber Djordje', 37, 'Honvéd FC', 'Középpályás'),
('Keresztes Noel', 38, 'Honvéd FC', 'Középpályás'),
('Kesztyűs Barna', 39, 'Honvéd FC', 'Középpályás'),
('Nagy Gergő', 41, 'Honvéd FC', 'Középpályás'),
('Uzoma Eke', 44, 'Honvéd FC', 'Középpályás'),
('Zsótér Donát', 45, 'Honvéd FC', 'Középpályás'),
('Balogh Norbert', 46, 'Honvéd FC', 'Támadó'),
('Eppel Márton', 47, 'Honvéd FC', 'Támadó'),
('Cipf Dominik', 48, 'Honvéd FC', 'Támadó'),
('Gale Thierry', 49, 'Honvéd FC', 'Támadó'),
('Németh Dániel', 51, 'Honvéd FC', 'Támadó'),
('Szendrei Norbert', 52, 'Honvéd FC', 'Támadó'),
('Tóth-Gábor Kristóf', 53, 'Honvéd FC', 'Támadó'),
('Ugrai Roland', 54, 'Honvéd FC', 'Támadó'),
('Banai Dávid', 55, 'Újpest', 'Kapus'),
('Németh Márk', 56, 'Újpest', 'Kapus'),
('Pajovic Filip', 57, 'Újpest', 'Kapus'),
('Antonov Nemanja', 58, 'Újpest', 'Védő'),
('Koutroumpis Georgios', 59, 'Újpest', 'Védő'),
('Pauljevic Branko', 61, 'Újpest', 'Védő'),
('Perosevic Antonio', 62, 'Újpest', 'Védő'),
('Ristevski Kire', 63, 'Újpest', 'Védő'),
('Baosic Jovan', 64, 'Újpest', 'Középpályás'),
('Beridze Giorgi', 65, 'Újpest', 'Középpályás'),
('Bjelos Miroslav', 66, 'Újpest', 'Középpályás'),
('Fehér Csanád Levente', 67, 'Újpest', 'Középpályás'),
('Katona Mátyás', 68, 'Újpest', 'Középpályás'),
('Mitrovic Nikola', 69, 'Újpest', 'Középpályás'),
('Stieber Zoltán', 71, 'Újpest', 'Középpályás'),
('Szakály Péter', 72, 'Újpest', 'Középpályás'),
('Varga Balázs', 73, 'Újpest', 'Középpályás'),
('Bacsa Patrik', 74, 'Újpest', 'Támadó'),
('Büki Dániel', 75, 'Újpest', 'Támadó'),
('Csongvai Áron', 76, 'Újpest', 'Támadó'),
('Gigic Petar', 77, 'Újpest', 'Támadó'),
('Kastrati Lirim', 78, 'Újpest', 'Támadó'),
('Laczik Levente', 79, 'Újpest', 'Támadó'),
('Simon Krisztián', 81, 'Újpest', 'Támadó'),
('Tallo', 82, 'Újpest', 'Támadó'),
('Antal Botond', 83, 'Diósgyőri VTK', 'Kapus'),
('Danilovic Branislav', 84, 'Diósgyőri VTK', 'Kapus'),
('Drazic Stefan', 85, 'Diósgyőri VTK', 'Védő'),
('Hegedűs János', 86, 'Diósgyőri VTK', 'Védő'),
('Karan Dejan', 87, 'Diósgyőri VTK', 'Védő'),
('Memolla Hysen', 88, 'Diósgyőri VTK', 'Védő'),
('Polgár Kristóf', 89, 'Diósgyőri VTK', 'Védő'),
('Vági András', 91, 'Diósgyőri VTK', 'Védő'),
('Grozav Gheorghe', 92, 'Diósgyőri VTK', 'Középpályás'),
('Hasani Florent', 93, 'Diósgyőri VTK', 'Középpályás'),
('Iszlai Bence', 94, 'Diósgyőri VTK', 'Középpályás'),
('Max Augusto', 95, 'Diósgyőri VTK', 'Középpályás'),
('Molnár Gábor', 96, 'Diósgyőri VTK', 'Középpályás'),
('Pedro Rui', 97, 'Diósgyőri VTK', 'Középpályás'),
('Shestakov Sergiy', 98, 'Diósgyőri VTK', 'Középpályás'),
('Ivanovski Mirko', 99, 'Diósgyőri VTK', 'Támadó'),
('Korbély Kristóf', 100, 'Diósgyőri VTK', 'Támadó'),
('Makrai Gábor', 101, 'Diósgyőri VTK', 'Támadó'),
('Márkvárt Dávid', 102, 'Diósgyőri VTK', 'Támadó'),
('Demjén Patrik', 103, 'Zalaegerszeg', 'Kapus'),
('Bedi Bence', 104, 'Zalaegerszeg', 'Védő'),
('Bobál Dávid', 105, 'Zalaegerszeg', 'Védő'),
('Gergényi Bence', 106, 'Zalaegerszeg', 'Védő'),
('Szalai Dániel', 107, 'Zalaegerszeg', 'Védő'),
('Szépe János', 108, 'Zalaegerszeg', 'Védő'),
('Tanasin Aleksandar', 109, 'Zalaegerszeg', 'Védő'),
('Zivko Ziga', 110, 'Zalaegerszeg', 'Védő'),
('Koszta Márk', 112, 'Zalaegerszeg', 'Középpályás'),
('Lesjak Zoran', 113, 'Zalaegerszeg', 'Középpályás'),
('Sankovic Bojan', 114, 'Zalaegerszeg', 'Középpályás'),
('Tajti Matyás', 115, 'Zalaegerszeg', 'Középpályás'),
('Vass Patrik', 116, 'Zalaegerszeg', 'Középpályás'),
('Babati Benjamin', 117, 'Zalaegerszeg', 'Támadó'),
('Dragóner Filip', 118, 'Zalaegerszeg', 'Támadó'),
('Kovács Barnabás', 119, 'Zalaegerszeg', 'Támadó'),
('Kun Bertalan', 120, 'Zalaegerszeg', 'Támadó'),
('Könyves Norbert', 121, 'Zalaegerszeg', 'Támadó'),
('Szánthó Regő', 122, 'Zalaegerszeg', 'Támadó'),
('Zimonyi Dávid', 123, 'Zalaegerszeg', 'Támadó'),
('Póser Dániel', 124, 'Budafok', 'Kapus'),
('Huszti András', 125, 'Budafok', 'Védő'),
('Khiesz Kornél', 126, 'Budafok', 'Védő'),
('Kirják Henrik', 127, 'Budafok', 'Védő'),
('Nikolic Marko', 128, 'Budafok', 'Védő'),
('Romic Danijel', 129, 'Budafok', 'Védő'),
('Vaszicsku Gergő', 130, 'Budafok', 'Védő'),
('Filkor Attila', 131, 'Budafok', 'Középpályás'),
('Ihrig-Farkas Sebestyén', 132, 'Budafok', 'Középpályás'),
('Kulcsár Kornél', 133, 'Budafok', 'Középpályás'),
('Margitics Andor', 134, 'Budafok', 'Középpályás'),
('Medgyes Sinan', 135, 'Budafok', 'Középpályás'),
('Micsinai Miklós', 136, 'Budafok', 'Középpályás'),
('Oláh Bálint', 137, 'Budafok', 'Középpályás'),
('Soltész István', 138, 'Budafok', 'Középpályás'),
('Fekete Máté', 139, 'Budafok', 'Támadó'),
('Kovács Dávid', 140, 'Budafok', 'Támadó'),
('Lőrinczy Attila', 141, 'Budafok', 'Támadó'),
('Mervó Bence', 142, 'Budafok', 'Támadó'),
('Skribek Alen', 143, 'Budafok', 'Támadó'),
('Szabó Máté', 144, 'Budafok', 'Támadó'),
('Takács Ronald', 145, 'Budafok', 'Támadó'),
('Zsóri Dániel', 146, 'Budafok', 'Támadó'),
('Auerbach Martin', 147, 'Puskás Akadémia', 'Kapus'),
('Tóth Balázs', 148, 'Puskás Akadémia', 'Kapus'),
('Deutsch László', 149, 'Puskás Akadémia', 'Védő'),
('Hadzhiev Kamen', 150, 'Puskás Akadémia', 'Védő'),
('Meissner Thomas', 151, 'Puskás Akadémia', 'Védő'),
('Nagy Zsolt', 152, 'Puskás Akadémia', 'Védő'),
('Nunes Joao', 153, 'Puskás Akadémia', 'Védő'),
('Spandler Csaba', 154, 'Puskás Akadémia', 'Védő'),
('Szolnoki Roland', 155, 'Puskás Akadémia', 'Védő'),
('Baluta Alexandru', 156, 'Puskás Akadémia', 'Középpályás'),
('Corbu Marius', 157, 'Puskás Akadémia', 'Középpályás'),
('Ganbold Ganbayar', 158, 'Puskás Akadémia', 'Középpályás'),
('Knezevic Josip', 159, 'Puskás Akadémia', 'Középpályás'),
('Komáromi György', 160, 'Puskás Akadémia', 'Középpályás'),
('Plsek Jakub', 161, 'Puskás Akadémia', 'Középpályás'),
('Radics Márton', 162, 'Puskás Akadémia', 'Középpályás'),
('Sipos Gábor', 163, 'Puskás Akadémia', 'Középpályás'),
('Urblik Jozef', 164, 'Puskás Akadémia', 'Középpályás'),
('van Nieff Yoell', 165, 'Puskás Akadémia', 'Középpályás'),
('Kiss Tamás', 166, 'Puskás Akadémia', 'Támadó'),
('Mance Antonio', 167, 'Puskás Akadémia', 'Támadó'),
('Slagveer Luciano', 168, 'Puskás Akadémia', 'Támadó'),
('Tamás Nándor', 169, 'Puskás Akadémia', 'Támadó'),
('Vanecek David', 170, 'Puskás Akadémia', 'Támadó'),
('de Melo Weslen Junior Faustino', 171, 'Puskás Akadémia', 'Támadó'),
('Hegedűs Lajos', 172, 'Paks', 'Kapus'),
('Holczer Ádám', 173, 'Paks', 'Kapus'),
('Gévay Zsolt', 175, 'Paks', 'Védő'),
('Lenzsér Bence', 176, 'Paks', 'Védő'),
('Osváth Attila', 177, 'Paks', 'Védő'),
('Szabó János', 178, 'Paks', 'Védő'),
('Szélpál Norbert', 179, 'Paks', 'Védő'),
('Bertus Lajos', 181, 'Paks', 'Középpályás'),
('Bognár István', 182, 'Paks', 'Középpályás'),
('Csősz Richárd', 183, 'Paks', 'Középpályás'),
('Debreceni Ákos', 184, 'Paks', 'Középpályás'),
('Hahn János', 185, 'Paks', 'Középpályás'),
('Kulcsár Dávid', 186, 'Paks', 'Középpályás'),
('Lorentz Márton', 187, 'Paks', 'Középpályás'),
('Nagy Richárd', 188, 'Paks', 'Középpályás'),
('Sipos Zoltán', 189, 'Paks', 'Középpályás'),
('Szakály Dénes', 190, 'Paks', 'Középpályás'),
('Vas Gábor', 191, 'Paks', 'Középpályás'),
('Windecker József', 192, 'Paks', 'Középpályás'),
('Böde Dániel', 193, 'Paks', 'Támadó'),
('Haraszti Zsolt', 194, 'Paks', 'Támadó'),
('Nagy Richárd', 195, 'Paks', 'Támadó'),
('Sajbán Máté', 196, 'Paks', 'Támadó'),
('Szendrei Ákos', 197, 'Paks', 'Támadó'),
('Ádám Martin', 198, 'Paks', 'Támadó'),
('Mijatovic Milan', 199, 'MTK Budapest', 'Kapus'),
('Ferreira Tiago', 201, 'MTK Budapest', 'Védő'),
('Herrera Sebastian', 202, 'MTK Budapest', 'Védő'),
('Katona Máté', 203, 'MTK Budapest', 'Védő'),
('Nagy Zsombor', 204, 'MTK Budapest', 'Védő'),
('Varju Benedek', 205, 'MTK Budapest', 'Védő'),
('Balázs Benjámin', 206, 'MTK Budapest', 'Középpályás'),
('Barna Szabolcs', 207, 'MTK Budapest', 'Középpályás'),
('Biben Barnabás László', 208, 'MTK Budapest', 'Középpályás'),
('Cseke Benjámin', 209, 'MTK Budapest', 'Középpályás'),
('Dimitrov Srdan', 210, 'MTK Budapest', 'Középpályás'),
('Ikenne-King George', 211, 'MTK Budapest', 'Középpályás'),
('Kata Mihály', 212, 'MTK Budapest', 'Középpályás'),
('Mezei Szabolcs', 213, 'MTK Budapest', 'Középpályás'),
('Palincsár Martin', 214, 'MTK Budapest', 'Középpályás'),
('Prosser Dániel', 215, 'MTK Budapest', 'Középpályás'),
('Bíró Bence', 216, 'MTK Budapest', 'Támadó'),
('Gera Dániel', 217, 'MTK Budapest', 'Támadó'),
('Kanta József', 218, 'MTK Budapest', 'Támadó'),
('Lencse László', 219, 'MTK Budapest', 'Támadó'),
('Miovski Bojan', 220, 'MTK Budapest', 'Támadó'),
('Myke', 221, 'MTK Budapest', 'Támadó'),
('Schön Szabolcs', 222, 'MTK Budapest', 'Támadó'),
('Kovácsik Ádám', 223, 'MOL Fehérvár FC', 'Kapus'),
('Rockov Emil', 224, 'MOL Fehérvár FC', 'Kapus'),
('Fiola Attila', 225, 'MOL Fehérvár FC', 'Védő'),
('Musliu Visar', 226, 'MOL Fehérvár FC', 'Védő'),
('Nego Loic', 227, 'MOL Fehérvár FC', 'Védő'),
('Rus Adrián', 228, 'MOL Fehérvár FC', 'Védő'),
('Stopira', 229, 'MOL Fehérvár FC', 'Védő'),
('Alef', 230, 'MOL Fehérvár FC', 'Középpályás'),
('Géresi Krisztián', 231, 'MOL Fehérvár FC', 'Középpályás'),
('Hangya Szilveszter', 232, 'MOL Fehérvár FC', 'Középpályás'),
('Houri Lyes', 233, 'MOL Fehérvár FC', 'Középpályás'),
('Nikolov Boban', 234, 'MOL Fehérvár FC', 'Középpályás'),
('Petrjak Ivan', 235, 'MOL Fehérvár FC', 'Középpályás'),
('Pinto Ruben', 236, 'MOL Fehérvár FC', 'Középpályás'),
('Bamgboye Funsho', 237, 'MOL Fehérvár FC', 'Támadó'),
('Bolla Bendegúz', 238, 'MOL Fehérvár FC', 'Támadó'),
('Evandro', 239, 'MOL Fehérvár FC', 'Támadó'),
('Nikolic Nemanja', 240, 'MOL Fehérvár FC', 'Támadó'),
('Zivzivadze Budu', 241, 'MOL Fehérvár FC', 'Támadó'),
('Dombó Dávid', 242, 'Kisvárda', 'Kapus'),
('Minca Mihai', 243, 'Kisvárda', 'Kapus'),
('Baranyai Ádám', 244, 'Kisvárda', 'Védő'),
('Datkovic Niko', 245, 'Kisvárda', 'Védő'),
('Ene Cornel', 246, 'Kisvárda', 'Védő'),
('Kravchenko Anton', 247, 'Kisvárda', 'Védő'),
('Rubus Tamás', 248, 'Kisvárda', 'Védő'),
('Bumba Claudiu', 249, 'Kisvárda', 'Középpályás'),
('Camaj Driton', 250, 'Kisvárda', 'Középpályás'),
('Cukalasz', 251, 'Kisvárda', 'Középpályás'),
('Hei Viktor', 252, 'Kisvárda', 'Középpályás'),
('Karaszjuk Roman', 253, 'Kisvárda', 'Középpályás'),
('Kovácsréti Márk', 254, 'Kisvárda', 'Középpályás'),
('Kukoc Tonci', 255, 'Kisvárda', 'Középpályás'),
('Melnyk Bogdan', 256, 'Kisvárda', 'Középpályás'),
('Simovic Slobodan', 257, 'Kisvárda', 'Középpályás'),
('Zlicic Lazar', 258, 'Kisvárda', 'Középpályás'),
('Horváth Zoltán', 259, 'Kisvárda', 'Támadó'),
('Jelena Richárd', 260, 'Kisvárda', 'Támadó'),
('Lucas', 261, 'Kisvárda', 'Támadó'),
('Navrátil Jaroslav', 262, 'Kisvárda', 'Támadó'),
('Sassa', 263, 'Kisvárda', 'Támadó'),
('Viana Fernando', 264, 'Kisvárda', 'Támadó'),
('Dibusz Dénes', 265, 'Ferencvárosi TC', 'Kapus'),
('Blazic Miha', 266, 'Ferencvárosi TC', 'Védő'),
('Botka Endre', 267, 'Ferencvárosi TC', 'Védő'),
('Civic Eldar', 268, 'Ferencvárosi TC', 'Védő'),
('Dvali Lasha', 269, 'Ferencvárosi TC', 'Védő'),
('Frimpong Abraham', 270, 'Ferencvárosi TC', 'Védő'),
('Kovacevic Adnan', 271, 'Ferencvárosi TC', 'Védő'),
('Heister Marcel', 272, 'Ferencvárosi TC', 'Középpályás'),
('Isael da Silva Barbosa', 273, 'Ferencvárosi TC', 'Középpályás'),
('Kharatin Igor', 274, 'Ferencvárosi TC', 'Középpályás'),
('Laidouni Aissa', 275, 'Ferencvárosi TC', 'Középpályás'),
('Mak Robert', 276, 'Ferencvárosi TC', 'Középpályás'),
('Nguen Tokmac', 277, 'Ferencvárosi TC', 'Középpályás'),
('Sigér Dávid', 278, 'Ferencvárosi TC', 'Középpályás'),
('Skvarka Michal', 279, 'Ferencvárosi TC', 'Középpályás'),
('Somalia', 280, 'Ferencvárosi TC', 'Középpályás'),
('Uzuni Myrto', 281, 'Ferencvárosi TC', 'Középpályás'),
('Vécsei Bálint', 282, 'Ferencvárosi TC', 'Középpályás'),
('Zubkov Oleksandr', 283, 'Ferencvárosi TC', 'Középpályás'),
('Baturina Roko', 284, 'Ferencvárosi TC', 'Támadó'),
('Boli Franck', 285, 'Ferencvárosi TC', 'Támadó'),
('Lovrencsics Gergő', 286, 'Ferencvárosi TC', 'Támadó'),
('Varga Roland', 287, 'Ferencvárosi TC', 'Támadó'),
('Patrick', 288, 'Ferencvárosi TC', 'Támadó'),
('Kószó Patrick asd', 289, 'Budafok', 'Középpályás'),
('asd', 290, 'Budafok', 'Kapus');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `meccsek`
--

CREATE TABLE `meccsek` (
  `Meccs azonosítója` int(5) NOT NULL,
  `Hazai csapat` text NOT NULL,
  `Vendég csapat` text NOT NULL,
  `Eredmény` varchar(5) NOT NULL,
  `Forduló` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `meccsek`
--

INSERT INTO `meccsek` (`Meccs azonosítója`, `Hazai csapat`, `Vendég csapat`, `Eredmény`, `Forduló`) VALUES
(3, 'Zalaegerszeg', 'MOL Fehérvár FC', '3-3', 1),
(4, 'Diósgyőri VTK', 'Mezőkövesd', '2-1', 1),
(5, 'Budafok', 'Kisvárda', '2-1', 1),
(6, 'Puskás Akadémia', 'Honvéd FC', '1-0', 1),
(7, 'Mezőkövesd', 'Zalaegerszeg', '1-1', 2),
(8, 'MTK Budapest', 'Honvéd FC', '3-1', 2),
(9, 'MOL Fehérvár FC', 'Paks', '1-1', 2),
(10, 'Újpest', 'Budafok', '1-1', 2),
(11, 'Kisvárda', 'Puskás Akadémia', '0-3', 2),
(12, 'Diósgyőri VTK', 'MTK Budapest', '1-1', 3),
(13, 'Paks', 'Mezőkövesd', '1-2', 3),
(14, 'Budafok', 'MOL Fehérvár FC', '1-4', 3),
(15, 'Zalaegerszeg', 'Ferencvárosi TC', '1-2', 3),
(16, 'Puskás Akadémia', 'Újpest', '3-2', 3),
(17, 'Honvéd FC', 'Kisvárda', '1-2', 3),
(18, 'Ferencvárosi TC', 'Paks', '5-0', 4),
(19, 'Mezőkövesd', 'Budafok', '1-0', 4),
(20, 'Diósgyőri VTK', 'Honvéd FC', '2-4', 4),
(21, 'MOL Fehérvár FC', 'Puskás Akadémia', '3-1', 4),
(22, 'Újpest', 'Kisvárda', '2-4', 4),
(23, 'MTK Budapest', 'Zalaegerszeg', '0-3', 4),
(24, 'Puskás Akadémia', 'Mezőkövesd', '1-0', 5),
(25, 'Paks', 'MTK Budapest', '4-0', 5),
(26, 'Zalaegerszeg', 'Diósgyőri VTK', '3-1', 5),
(27, 'Honvéd FC', 'Újpest', '1-2', 5),
(33, 'MTK Budapest', 'Budafok', '1-2', 6),
(34, 'Mezőkövesd', 'Kisvárda', '1-2', 6),
(35, 'Diósgyőri VTK', 'Paks', '1-2', 6),
(36, 'Zalaegerszeg', 'Honvéd FC', '2-4', 6),
(37, 'Ferencvárosi TC', 'Puskás Akadémia', '2-1', 6),
(38, 'MOL Fehérvár FC', 'Újpest', '5-1', 6),
(39, 'Kisvárda', 'Ferencvárosi TC', '0-2', 7),
(40, 'Budafok', 'Diósgyőri VTK', '2-1', 7),
(41, 'Újpest', 'Mezőkövesd', '1-0', 7),
(42, 'Puskás Akadémia', 'MTK Budapest', '0-3', 7),
(43, 'Paks', 'Zalaegerszeg', '3-1', 7),
(44, 'Honvéd FC', 'MOL Fehérvár FC', '2-2', 7),
(45, 'MTK Budapest', 'Kisvárda', '1-1', 8),
(46, 'Paks', 'Honvéd FC', '0-0', 8),
(47, 'Ferencvárosi TC', 'Újpest', '2-0', 8),
(48, 'Zalaegerszeg', 'Budafok', '1-3', 8),
(49, 'Mezőkövesd', 'MOL Fehérvár FC', '1-2', 8),
(50, 'Diósgyőri VTK', 'Puskás Akadémia', '3-0', 8),
(51, 'Puskás Akadémia', 'Zalaegerszeg', '1-2', 9),
(52, 'Honvéd FC', 'Mezőkövesd', '1-1', 9),
(53, 'MOL Fehérvár FC', 'Ferencvárosi TC', '1-1', 9),
(54, 'Budafok', 'Paks', '2-3', 9),
(55, 'Újpest', 'MTK Budapest', '0-4', 9),
(56, 'Kisvárda', 'Diósgyőri VTK', '1-0', 9),
(57, 'Diósgyőri VTK', 'Újpest', '3-0', 10),
(58, 'Paks', 'Puskás Akadémia', '6-2', 10),
(59, 'MTK Budapest', 'MOL Fehérvár FC', '3-1', 10),
(60, 'Zalaegerszeg', 'Kisvárda', '1-2', 10),
(61, 'Ferencvárosi TC', 'Mezőkövesd', '3-0', 10),
(63, 'Kisvárda', 'Paks', '3-1', 11),
(64, 'Puskás Akadémia', 'Budafok', '3-0', 11),
(65, 'Mezőkövesd', 'MTK Budapest', '0-1', 11),
(66, 'Honvéd FC', 'Ferencvárosi TC', '0-1', 11),
(67, 'MOL Fehérvár FC', 'Diósgyőri VTK', '3-0', 11),
(69, 'Paks', 'Újpest', '1-2', 1),
(74, 'Budafok', 'Ferencvárosi TC', '0-0', 90),
(75, 'Kisvárda', 'Újpest', '1-1', 91),
(81, 'Ferencvárosi TC', 'MTK Budapest', '1-1', 1),
(82, 'Budafok', 'Ferencvárosi TC', '0-1', 66);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tabella`
--

CREATE TABLE `tabella` (
  `Csapat neve` text NOT NULL,
  `Lejátszott fordulók` int(2) NOT NULL,
  `Győzelmek` int(2) NOT NULL,
  `Döntetlenek` int(2) NOT NULL,
  `Vereségek` int(2) NOT NULL,
  `Lőtt gólok` int(3) NOT NULL,
  `Kapott Gólok` int(3) NOT NULL,
  `Gólkülönbség` int(3) NOT NULL,
  `Pontok` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `tabella`
--

INSERT INTO `tabella` (`Csapat neve`, `Lejátszott fordulók`, `Győzelmek`, `Döntetlenek`, `Vereségek`, `Lőtt gólok`, `Kapott Gólok`, `Gólkülönbség`, `Pontok`) VALUES
('Budafok', 11, 4, 2, 5, 13, 17, -4, 14),
('Diósgyőri VTK', 10, 3, 1, 6, 14, 17, -3, 10),
('Ferencvárosi TC', 11, 7, 4, 0, 20, 4, 16, 27),
('Honvéd FC', 10, 2, 3, 5, 14, 16, -2, 9),
('Kisvárda', 11, 6, 2, 3, 17, 15, 2, 20),
('Mezőkövesd', 11, 2, 2, 7, 8, 15, -7, 8),
('MOL Fehérvár FC', 10, 5, 4, 1, 25, 14, 11, 19),
('MTK Budapest', 12, 5, 4, 3, 19, 15, 4, 19),
('Paks', 10, 5, 2, 3, 21, 17, 4, 17),
('Puskás Akadémia', 11, 5, 0, 6, 16, 21, -5, 15),
('Újpest', 10, 2, 2, 6, 10, 24, -14, 8),
('Zalaegerszeg', 10, 3, 2, 5, 18, 20, -2, 11);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `csapatok`
--
ALTER TABLE `csapatok`
  ADD PRIMARY KEY (`Név`(30));

--
-- A tábla indexei `jatekosok`
--
ALTER TABLE `jatekosok`
  ADD PRIMARY KEY (`Személyi szám`);

--
-- A tábla indexei `meccsek`
--
ALTER TABLE `meccsek`
  ADD PRIMARY KEY (`Meccs azonosítója`);

--
-- A tábla indexei `tabella`
--
ALTER TABLE `tabella`
  ADD PRIMARY KEY (`Csapat neve`(30));

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `jatekosok`
--
ALTER TABLE `jatekosok`
  MODIFY `Személyi szám` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT a táblához `meccsek`
--
ALTER TABLE `meccsek`
  MODIFY `Meccs azonosítója` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
