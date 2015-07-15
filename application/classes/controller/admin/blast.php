<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Admin_Blast extends Controller_Master
{
    function before()
    {
        parent::before();

        Functions::check_loggedin(TRUE, TRUE);
    }

    function action_filter($filter)
    {
        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/blast/select')->bind('results', $results);

        $chat_start = Arr::get($_POST, 'chat_start', 'today -7 days');
        $chat_end = Arr::get($_POST, 'chat_end', 'today 23:59:59');
        $order = Arr::get($_GET, 'order', 'lastmsg');

        switch($filter)
        {
            case '1': // Melissa
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'IN', new Database_Expression("('LittleMissFiona','NaughtyJayme','MsGreen','KnoxvilleKisses','SexiLexi','Lustykisses2','JessieSexy','BlondeBadGrrrl','Bootylicious669','AllBoutDatBass','SchoolGrlCrush','SunkissedBlond','sxybooty','AshevilleMade','MissMuggle','LaineyinEC','RedhedCntryGrl','GoodGollyMissHolly','HornyTXHousewife','LilyVanilli','beercitybrunette','pinkiepie69','cutekitty061','Sylviexo','BabySoTiCNG','TabbiKitten','angela31','MissPurrfect','alisabdd','hardbodygrl','goodloving1','Lasia','SweetMelissa','kinkykatie','SoSoSweet69','SavannahLynn','BBGotDSLs4Dayz','CookiePuss','OhMyChai','StrawbryShortcake','sactownbaby','Kayleigh9569','HoosierGirl317','x_LonelyInAz_x','SxyBiGal4Play','HunnyBunz669','sxyjenni212','MollyPop','shybutbad85','staceyk','sexyjenni','hotluving08','havalove', 'mrsbrowntaste', 'daylynn00', 'gail_loves_pvc', 'angelina2', 'chicaloco71', 'GastownGirl', 'SexyHornyMom', 'hotwhornyfor', 'snowbunny4u', 'candihotready', 'XBabyxBreeX', 'hottie4u2eat', 'CrystalVixen', 'quickyqueen', 'angel2123', 'livelongnparty', 'wendythompsone', 'Twixxj', 'HornyEmmy', 'cutiewithboobys', '2hot2beture', 'MissReaganRae', 'badtink', 'spartygirl89', '2cute4u2miss', 'sexysadie', 'stillgotit78', 'BamaBaby205','QTnessa','HottieDeLuXXX13','Emilyxoxanna','bettycocker','heartslove19','nicolehottie','sxyshygrrrl','rachelle','mgdbabe','txtruelove','GoldieLoxxx','DurtyGurl69','hottnbubbly','loveallofit','hellokittygirlie','burien85','chezza444','louday','Amber5434','SweetSabine','KissMeDeadly','Aristar','janisj','bebenathy','LegsThatGoForever','lizdown_onit','snakedgirl003','bissy4','LAGinger','sweetlilanna','justlookin426','lavinia9907','creola479','NikkiFreaksYou','KendraAllKendra','dmysha','sexydana','wethotgirl821','DaniLicious','KennWaKitty','me3334','Alaskanchic','jessysexy','SxyJanice82','missginger','YahYahGumbo','brngnsexibck','luvzh2o','imoist4u','Rough77','surpriseme','Tristan77','hotforit','grneyesnsexy','BigRed1977','hotguyseekingme','juicyjudey','AngelaHotForSex','sweetkywoman','Playingnow1598','715sexy','FreeRini','hornynshaperr','missuzy','rita','SarahRavensFan','Apple101','lucyloo6969','CoventryGal','Josslyn','randygilr','makeitwet908','xxxtina','sexylatin000','sweetsara18','PrincessCherry','Rayna11138','lenox61','KissyFur','Carolyn777','DaytonaLinda','thighhighs','TruJayde','Lia1976','krissylee','SexInLittleRock','dailydose','desirable','JessicaBurr','scblueeyes13','Stace23','Raychel611','sexysinglemammi','JaiMonet','discreetsex270','sexray19','onlreloves','Futureness','wild_cookie73','justalways456','CLL98745','tcbb27','AintGotAClue','KikiDynamite','Honeynnc','marymovesit','playbaby','CR700','frydfairy','ImKasey','wetwild69bi','callyhotslut','belivsexy','SxyJanice82','holly2169','Mitchaser23','mellee1','TattsnTits','fleurduprintemp','tastymaggie','28flower','EmilyFine','diamondeye','KissmeTess','shadowgrl','kinkygirl','southernsweet','TamChick','MzNewBooty','lonelwoman','kiyyana','lovetogvhead','lovabigdick','theblonde','stefoney','hann2k','mariegirl','naughtynurse','Pussygalore09','remolove1','BentOver4UXXX','Freckles','whereareyou','wise','sexUal1_043','hornygirl','Loraxxx87','goldengal006')"))
                    ->order_by($order, 'DESC')->find_all();
                break;

            case '2': // Michelle
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'NOT IN', new Database_Expression("('LittleMissFiona','NaughtyJayme','MsGreen','KnoxvilleKisses','SexiLexi','Lustykisses2','JessieSexy','BlondeBadGrrrl','Bootylicious669','AllBoutDatBass','SchoolGrlCrush','SunkissedBlond','sxybooty','AshevilleMade','MissMuggle','LaineyinEC','RedhedCntryGrl','GoodGollyMissHolly','HornyTXHousewife','LilyVanilli','beercitybrunette','pinkiepie69','cutekitty061','Sylviexo','BabySoTiCNG','TabbiKitten','angela31','MissPurrfect','alisabdd','hardbodygrl','goodloving1','Lasia','SweetMelissa','kinkykatie','SoSoSweet69','SavannahLynn','BBGotDSLs4Dayz','CookiePuss','OhMyChai','StrawbryShortcake','sactownbaby','Kayleigh9569','HoosierGirl317','x_LonelyInAz_x','SxyBiGal4Play','HunnyBunz669','sxyjenni212','MollyPop','shybutbad85','staceyk','sexyjenni','hotluving08','havalove', 'mrsbrowntaste', 'daylynn00', 'gail_loves_pvc', 'angelina2', 'chicaloco71', 'GastownGirl', 'SexyHornyMom', 'hotwhornyfor', 'snowbunny4u', 'candihotready', 'XBabyxBreeX', 'hottie4u2eat', 'CrystalVixen', 'quickyqueen', 'angel2123', 'livelongnparty', 'wendythompsone', 'Twixxj', 'HornyEmmy', 'cutiewithboobys', '2hot2beture', 'MissReaganRae', 'badtink', 'spartygirl89', '2cute4u2miss', 'sexysadie', 'stillgotit78', 'BamaBaby205','QTnessa','HottieDeLuXXX13','Emilyxoxanna','bettycocker','heartslove19','nicolehottie','sxyshygrrrl','rachelle','mgdbabe','txtruelove','GoldieLoxxx','DurtyGurl69','hottnbubbly','loveallofit','hellokittygirlie','burien85','chezza444','louday','Amber5434','SweetSabine','KissMeDeadly','Aristar','janisj','bebenathy','LegsThatGoForever','lizdown_onit','snakedgirl003','bissy4','LAGinger','sweetlilanna','justlookin426','lavinia9907','creola479','NikkiFreaksYou','KendraAllKendra','dmysha','sexydana','wethotgirl821','DaniLicious','KennWaKitty','me3334','Alaskanchic','jessysexy','SxyJanice82','missginger','YahYahGumbo','brngnsexibck','luvzh2o','imoist4u','Rough77','surpriseme','Tristan77','hotforit','grneyesnsexy','BigRed1977','hotguyseekingme','juicyjudey','AngelaHotForSex','sweetkywoman','Playingnow1598','715sexy','FreeRini','hornynshaperr','missuzy','rita','SarahRavensFan','Apple101','lucyloo6969','CoventryGal','Josslyn','randygilr','makeitwet908','xxxtina','sexylatin000','sweetsara18','PrincessCherry','Rayna11138','lenox61','KissyFur','Carolyn777','DaytonaLinda','thighhighs','TruJayde','Lia1976','krissylee','SexInLittleRock','dailydose','desirable','JessicaBurr','scblueeyes13','Stace23','Raychel611','sexysinglemammi','JaiMonet','discreetsex270','sexray19','onlreloves','Futureness','wild_cookie73','justalways456','CLL98745','tcbb27','AintGotAClue','KikiDynamite','Honeynnc','marymovesit','playbaby','CR700','frydfairy','ImKasey','wetwild69bi','callyhotslut','belivsexy','SxyJanice82','holly2169','Mitchaser23','mellee1','TattsnTits','fleurduprintemp','tastymaggie','28flower','EmilyFine','diamondeye','KissmeTess','shadowgrl','kinkygirl','southernsweet','TamChick','MzNewBooty','lonelwoman','kiyyana','lovetogvhead','lovabigdick','theblonde','stefoney','hann2k','mariegirl','naughtynurse','Pussygalore09','remolove1','BentOver4UXXX','Freckles','whereareyou','wise','sexUal1_043','hornygirl','Loraxxx87','goldengal006')"))
                    ->and_where('users.username', 'NOT IN', new Database_Expression("('SexyJessie','KasandraRed','EvilAshleigh94','shawneebabee','WillyNilly3', 'candyadria', 'diksukr6006', 'SocaRchika', 'ASHTONxxx', 'foreverwithyou', 'honeydipped', 'TaylorMade', 'tinapop', 'HartfordBabe', 'longtimenosex', 'sexxxy', 'Lillybet', 'helenaluv', 'KandyKisses', 'TootsieMelt', 'Mystique', 'jsexy4cum3', 'NewBorn5965', 'hothaze', 'richfun', 'badgirl3000', 'SweetSteph', 'natureisunfair','trustme','EntirelyUnique3','sexiimamii','gadget','more2sex','lachiara','kisstalon','alltaffy','HornyBlondGrl50','snowbunnie','Reden9','sweetlibra','PossibleLesi','ashley','4fun_nscvic','tooplease152','GracieLynnLawless','shellyyellow','boomshell69','AKAHotmama','1bitoplay','kendre515','gracefulhart30','aphroditexxx','ohhlalabb','briwantscock','ineedyouforme','nobodysperfect','mzmoneyflower','Marta615','partigurl7','sparkles737','laineyluvzxxx','MzNevaenuff','cutiegrlnmi4u','dubsd1','deedee81','yogie','aunry1975','juicybabe22','nitebedrmeye','bling655bling','greeneyediamond','nyshugababy','youngnympho','broken4ever','AfterPartyGal45','cherry999','BellaDonna33','truejayde','Justwantfun7','SexxxySally','jenijeni','pixelfaerie','justsex4dawn','sweetjayne','babygirl_401','huntedlady','naughty_hottie7','angieprettybaby','greeneyes','paulajones909','kitkat1980','SP0EPaso','golden','lindsey1250','hothanah','NaughtyJuJu','slaphappyjacki','hotjenni26','Shawmee','liltigress','goldengal066','powerofthepussy','ely712','Tracy_laa','sexxxykj','Missyxoxo','dirty22female','arista80','Lila_Sydney','ircords')"))
                    ->and_where('users.username', 'NOT IN', new Database_Expression("('KadyBug69','BoricuaBaby','Kiahxxx','AGirl2DoInDenver','BabyInBeaumont','chloebaboe','pussywillow','StickySweet420','SxyBlonde','X_rileycyrus_X','Dax87','SxyNaghtyLilThang','SweetPea93','JerseyGurley','GoodGrlGoneBad','CarrieBear6969','MaryAlice','foxxyroxxy','TastyCakes','slewis68','SWEETMANGO12','DaddysGurl','CarlaHrovatuezjj','singlemercy009','niczevans','acyoyo','lcharlie92','KaylaBabi','gorgeous_blonde','tucsonbrat','sexymamanh','Milkymary','foxxyflirt','ouija','queenoral','snapdragonlily','feverana','FullBody1235','becky','foryou_2002Cum','sexixithang20','daddysbratslut','kinkyme111','sexykatie4u','habanitaXo','alagbo009','sexyfriend099','nottyBear04','GorgeousKiddo','drews22','lilcowgirl','NDSexyChic18','flirtashley','sexdeprived87','JUICEY88','CaSuRfGiRl87','havingfun08','xxfreshflowerzz','rolandsweet','sexysonia30','sweetbuttercups','GingerLee999','sexyshassy','sephora','Briley08','kimberly5666','faith4real19','takesalicking','certifiedfreak','shortnsexy888','sweetsandra88','kinkykitten2004','slutty_ambie','annasquirt','iwantyou2lickme','Pootietang','bam2308','NightyNightBaby','jesfrench1','tight_lover5','kara1991','PartiGurlPaula','partyhottie80','amylee','monicawod','MissJuicy','JamiRoxxx','sexycat23','evelvsnikki','LisaLov988','kyli','Yajaira','angela','thismissto69U','imaslutttt')"))
                    ->and_where('users.username', 'NOT IN', new Database_Expression("('Sera4Anything','bjsandtacos','NaughtyJules','CurvyCutie4u','SnootchieBootchie','Suzzyy','GingerSnaps','YourGoddess','purrrrrXX','speaksdot','imera30q_u','kinkyPLAY','Ox_Missy_xO','zmikejghjgh','ctutelitt','0xCandyCrushx0','Irresistible','turnherbad','SugarNips','sweetiepie','BustyBrunette4Fun','CandyKissesXO','Gemini69','XxxMadisonxxX','TXSpursSpitfire','XSweetCarolineX','Tinkerbelle94','CrzyInAlabama','cutieinmillcity','SweetAria','SugarSweet69','HeatherForever','GemmaWantsIt','cutiepatootiexx','cataleya','xO_Hanna_Ox','goodcatholicgrl','littlekitten','BillingsBaby69','RoseHasThorns','Lick2Taste','BlackBetty88','haveyouseenher','xLafreniereBabyx','sammyjo','charisa','iamsamantha','HabsHoney','LilMissKiKi','JustJessi','Whitney4fwb','lilcutiiesmiles','sexymisty','thebichim','WantItHotNruf6','BoobChick','sexandthecity69','ParkCityPrincess','XxhoneyxX','pussypie','sexyashley1','darlingnikki','OzarkAngel69','BesameMucho','Milk_N_Honey','MzJuicyFruitz','SweetBabyShy','TNBuxomBadGirl','ashlieXskank','SweetLilliana','SugarBabie','NoelaniXoXo','Sapphire','kandyqueen','hazelnot','srchn4peyton','lilmissmonster','SpanishPosh','pair_o_dice','SxyBBW4Luv','GettinMyFreakOn','KellyLittleFox','WetHotNReady87','Bellissima718','DFWSundancer')"))
                    ->and_where('users.username', 'NOT IN', new Database_Expression("('MemphisBelle')"))
                    ->order_by($order, 'DESC')->find_all();
                break;

            case '3': // Mikey
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'IN', new Database_Expression("('SexyJessie','KasandraRed','EvilAshleigh94','shawneebabee','WillyNilly3', 'candyadria', 'diksukr6006', 'SocaRchika', 'ASHTONxxx', 'foreverwithyou', 'honeydipped', 'TaylorMade', 'tinapop', 'HartfordBabe', 'longtimenosex', 'sexxxy', 'Lillybet', 'helenaluv', 'KandyKisses', 'TootsieMelt', 'Mystique', 'jsexy4cum3', 'NewBorn5965', 'hothaze', 'richfun', 'badgirl3000', 'SweetSteph', 'natureisunfair','trustme','EntirelyUnique3','sexiimamii','gadget','more2sex','lachiara','kisstalon','alltaffy','HornyBlondGrl50','snowbunnie','Reden9','sweetlibra','PossibleLesi','ashley','4fun_nscvic','tooplease152','GracieLynnLawless','shellyyellow','boomshell69','AKAHotmama','1bitoplay','kendre515','gracefulhart30','aphroditexxx','ohhlalabb','briwantscock','ineedyouforme','nobodysperfect','mzmoneyflower','Marta615','partigurl7','sparkles737','laineyluvzxxx','MzNevaenuff','cutiegrlnmi4u','dubsd1','deedee81','yogie','aunry1975','juicybabe22','nitebedrmeye','bling655bling','greeneyediamond','nyshugababy','youngnympho','broken4ever','AfterPartyGal45','cherry999','BellaDonna33','truejayde','Justwantfun7','SexxxySally','jenijeni','pixelfaerie','justsex4dawn','sweetjayne','babygirl_401','huntedlady','naughty_hottie7','angieprettybaby','greeneyes','paulajones909','kitkat1980','SP0EPaso','golden','lindsey1250','hothanah','NaughtyJuJu','slaphappyjacki','hotjenni26','Shawmee','liltigress','goldengal066','powerofthepussy','ely712','Tracy_laa','sexxxykj','Missyxoxo','dirty22female','arista80','Lila_Sydney','ircords')"))
                    ->order_by($order, 'DESC')->find_all();
                break;

            case '4': // Tiffany
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'IN', new Database_Expression("('KadyBug69','BoricuaBaby','Kiahxxx','AGirl2DoInDenver','BabyInBeaumont','chloebaboe','pussywillow','StickySweet420','SxyBlonde','X_rileycyrus_X','Dax87','SxyNaghtyLilThang','SweetPea93','JerseyGurley','GoodGrlGoneBad','CarrieBear6969','MaryAlice','foxxyroxxy','TastyCakes','slewis68','SWEETMANGO12','DaddysGurl','CarlaHrovatuezjj','singlemercy009','niczevans','acyoyo','lcharlie92','KaylaBabi','gorgeous_blonde','tucsonbrat','sexymamanh','Milkymary','foxxyflirt','ouija','queenoral','snapdragonlily','feverana','FullBody1235','becky','foryou_2002Cum','sexixithang20','daddysbratslut','kinkyme111','sexykatie4u','habanitaXo','alagbo009','sexyfriend099','nottyBear04','GorgeousKiddo','drews22','lilcowgirl','NDSexyChic18','flirtashley','sexdeprived87','JUICEY88','CaSuRfGiRl87','havingfun08','xxfreshflowerzz','rolandsweet','sexysonia30','sweetbuttercups','GingerLee999','sexyshassy','sephora','Briley08','kimberly5666','faith4real19','takesalicking','certifiedfreak','shortnsexy888','sweetsandra88','kinkykitten2004','slutty_ambie','annasquirt','iwantyou2lickme','Pootietang','bam2308','NightyNightBaby','jesfrench1','tight_lover5','kara1991','PartiGurlPaula','partyhottie80','amylee','monicawod','MissJuicy','JamiRoxxx','sexycat23','evelvsnikki','LisaLov988','kyli','Yajaira','angela','thismissto69U','imaslutttt')"))
                    ->order_by($order, 'DESC')->find_all();

                    //print_r($results);
                break;

            case '5': // Ryan
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'IN', new Database_Expression("('Sera4Anything','bjsandtacos','NaughtyJules','CurvyCutie4u','SnootchieBootchie','Suzzyy','GingerSnaps','YourGoddess','purrrrrXX','speaksdot','imera30q_u','kinkyPLAY','Ox_Missy_xO','zmikejghjgh','ctutelitt','0xCandyCrushx0','Irresistible','turnherbad','SugarNips','sweetiepie','BustyBrunette4Fun','CandyKissesXO','Gemini69','XxxMadisonxxX','TXSpursSpitfire','XSweetCarolineX','Tinkerbelle94','CrzyInAlabama','cutieinmillcity','SweetAria','SugarSweet69','HeatherForever','GemmaWantsIt','cutiepatootiexx','cataleya','xO_Hanna_Ox','goodcatholicgrl','littlekitten','BillingsBaby69','RoseHasThorns','Lick2Taste','BlackBetty88','haveyouseenher','xLafreniereBabyx','sammyjo','charisa','iamsamantha','HabsHoney','LilMissKiKi','JustJessi','Whitney4fwb','lilcutiiesmiles','sexymisty','thebichim','WantItHotNruf6','BoobChick','sexandthecity69','ParkCityPrincess','XxhoneyxX','pussypie','sexyashley1','darlingnikki','OzarkAngel69','BesameMucho','Milk_N_Honey','MzJuicyFruitz','SweetBabyShy','TNBuxomBadGirl','ashlieXskank','SweetLilliana','SugarBabie','NoelaniXoXo','Sapphire','kandyqueen','hazelnot','srchn4peyton','lilmissmonster','SpanishPosh','pair_o_dice','SxyBBW4Luv','GettinMyFreakOn','KellyLittleFox','WetHotNReady87','Bellissima718','DFWSundancer')"))
                    ->order_by($order, 'DESC')->find_all();
                break;

            case '6': // Megan
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->and_where('users.username', 'IN', new Database_Expression("('MemphisBelle')"))
                    ->order_by($order, 'DESC')->find_all();
                break;
            default:
                $results = ORM::factory('user')
                    ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
                    ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
                    ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
                    ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
                    ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
                    ->order_by($order, 'DESC')
                    ->find_all();
                break;
        }
    }

    function action_index()
    {
        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/blast/select')->bind('results', $results);

        $chat_start = Arr::get($_POST, 'chat_start', 'today -7 days');
        $chat_end = Arr::get($_POST, 'chat_end', 'today 23:59:59');
        $order = Arr::get($_GET, 'order', 'lastmsg');

        $results = ORM::factory('user')
            ->select(new Database_Expression('(SELECT date_sent FROM messages IGNORE INDEX(ix_date_sent) WHERE to_id = users.id AND date_read IS NULL ORDER BY date_sent DESC LIMIT 1) as lastmsg'))
            ->select(new Database_Expression('(SELECT COUNT(id) FROM messages WHERE to_id = users.id AND date_read IS NULL) AS msgcount'))
            ->select(new Database_Expression('(SELECT COUNT(contact_type.id) FROM contacts JOIN contact_types AS contact_type ON contact_type.id = contacts.contact_type_id WHERE to_id = users.id AND type = \'Favorite\') AS crushcount'))
            ->select(new Database_Expression('(SELECT SUM(credits) FROM chat_tracker WHERE user_id = users.id AND type = \'Text\' AND date BETWEEN ' . strtotime('est ' . $chat_start) . ' AND ' . strtotime('est ' . $chat_end) . ') AS chatted'))
            ->where('membership_id', 'IN', new Database_Expression('(10, 11, 12)'))
            ->order_by('lastmsg', 'DESC')->find_all();
    }

    function action_email($user)
    {
        set_time_limit(0);

        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/blast/email')->bind('post', $post)->bind('count', $count)->bind('locations', $locations);

        $sql = "SELECT r.id, r.name
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '233'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['regions'] = array('' => 'Select A Region') + $data;

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['countries'] = $data;

        if ($_POST)
        {
            $post = $_POST;

            $users = ORM::factory('user');

            $users->where('membership_id', '=', $post['membership_id']);

            if ( ! empty($post['signup_date_after']))
            {
                $users->where('signup_date', '>=', strtotime($post['signup_date_after']));
            }

            if ( ! empty($post['signup_date_before']))
            {
                $users->where('signup_date', '<', strtotime($post['signup_date_before']));
            }

            if ( ! empty($post['country_id']))
            {
                $users->where('country_id', '=', $post['country_id']);
            }

            if ( ! empty($post['region_id']))
            {
                $users->where('region_id', '=', $post['region_id']);
            }

            if ( ! empty($post['city_id']))
            {
                $users->where('city_id', '=', $post['city_id']);
            }

            if ( ! empty($post['gender']))
            {
                $users->where('gender', '=', $post['gender']);
            }

            if ( ! empty($post['interested_in']))
            {
                $users->where('interested_in', '=', $post['interested_in']);
            }

            if ($post['action'] == 'count')
            {
                $count = $users->count_all();
            }
            else
            {
                $from = ORM::factory('user', array('username' => $user));

                $users = $users->find_all();
                $count = 0;
                $found = false;

                foreach($users as $to)
                {
                    if ( ! $found AND isset($post['resume_id']) AND ! empty($post['resume_id']))
                    {
                        if ($post['resume_id'] != $to->id)
                        {
                            continue;
                        }
                        else
                        {
                            $found = true;
                            continue;
                        }
                    }

                    if ($from->id != $to->id)
                    {
                        ORM::factory('view')->update($to, $from);

                        $message = ORM::factory('message');

                        $message->to_id = $to;
                        $message->from_id = $from;
                        $message->message_type_id = ORM::factory('message_type', array('type' => 'Mail'));
                        $message->subject = $post['subject'];
                        $message->message = Text::auto_p($post['message']);

                        $count++;;
                        $message->save();

                        Functions::send_email($to, $from);
                        //Mailer::factory('user')->send_email($from, $to);
                    }
                }

                Notify::set('pass', 'Your message was successfully sent to ' . $count . ' users');

                Request::instance()->redirect('admin/blast/email/' . $user);
            }
        }
    }

    function action_flirt($user)
    {
        set_time_limit(0);

        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/blast/flirt')->bind('post', $post)->bind('count', $count)->bind('messages', $messages)->bind('locations', $locations);

        $sql = "SELECT r.id, r.name
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '233'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['regions'] = array('' => 'Select A Region') + $data;

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['countries'] = $data;

        $messages = ORM::factory('template')->where('message_type_id', '=', ORM::factory('message_type', array('type' => 'Flirt')))->find_all();

        if ($_POST)
        {
            $post = $_POST;

            $users = ORM::factory('user');

            $users->where('membership_id', '=', $post['membership_id']);

            if ( ! empty($post['signup_date_after']))
            {
                $users->where('signup_date', '>=', strtotime($post['signup_date_after']));
            }

            if ( ! empty($post['signup_date_before']))
            {
                $users->where('signup_date', '<', strtotime($post['signup_date_before']));
            }

            if ( ! empty($post['country_id']))
            {
                $users->where('country_id', '=', $post['country_id']);
            }

            if ( ! empty($post['region_id']))
            {
                $users->where('region_id', '=', $post['region_id']);
            }

            if ( ! empty($post['city_id']))
            {
                $users->where('city_id', '=', $post['city_id']);
            }

            if ( ! empty($post['gender']))
            {
                $users->where('gender', '=', $post['gender']);
            }

            if ( ! empty($post['interested_in']))
            {
                $users->where('interested_in', '=', $post['interested_in']);
            }

            if ( ! empty($post['startid']))
            {
                $users->where('id', '>=', $post['startid']);
            }

            if ($post['action'] == 'count')
            {
                $count = $users->count_all();
            }
            else
            {
                if (isset($post['message']))
                {
                    $from = ORM::factory('user', array('username' => $user));

                    $users = $users->find_all();
                    $count = 0;

                    foreach($users as $to)
                    {
                        if ($from->id != $to->id)
                        {
                            $template = ORM::factory('template', $post['message']);
                            $message = ORM::factory('message');

                            $sent_today = $message->where('to_id', '=', $to)
                                ->where('from_id', '=', $from)
                                ->where('message_type_id', '=', $template->message_type)
                                ->where('date_sent', '>=', strtotime('est today'))
                                ->where('date_sent', '<=', strtotime('est now'))
                                ->count_all();

                            if ($sent_today >= 1)
                            {
                                continue;
                            }

                            ORM::factory('view')->update($to, $from);

                            $message->to_id = $to;
                            $message->from_id = $from;
                            $message->message_type_id = $template->message_type;
                            $message->subject = Functions::template_replace($template->subject, $from, $to);
                            $message->message = Text::auto_p(Functions::template_replace($template->message, $from, $to));

                            $message->save();
                            $count++;

                            Functions::send_flirt($to, $from);
                            //Mailer::factory('user')->send_flirt($from, $to);
                        }
                    }

                    Notify::set('pass', 'Your flirt was successfully sent to ' . $count . ' users');

                    Request::instance()->redirect('admin/blast/flirt/' . $user);
                }
            }
        }
    }

    function action_request($user)
    {
        set_time_limit(0);

        $this->template->head->meta_title = 'Admin Area';
        $this->template->content = View::factory('admin/blast/request')->bind('post', $post)->bind('count', $count)->bind('messages', $messages)->bind('locations', $locations);

        $sql = "SELECT r.id, r.name
                FROM regions r, countries c
                WHERE r.country_code = c.code AND c.id = '233'
                ORDER BY r.name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['regions'] = array('' => 'Select A Region') + $data;

        $sql = "SELECT id, name
                FROM countries
                ORDER BY CASE name WHEN 'United States' THEN 0 WHEN 'Canada' THEN 1 WHEN 'United Kingdom' THEN 2 WHEN 'Australia' THEN 3 ELSE 4 END ASC, name ASC";

        $data = DB::query(Database::SELECT, $sql)->cached(3600)->execute()->as_array('id', 'name');

        $locations['countries'] = $data;

        $messages = ORM::factory('template')->where('message_type_id', '=', ORM::factory('message_type', array('type' => 'Flirt')))->find_all();

        if ($_POST)
        {
            $post = $_POST;

            $users = ORM::factory('user');

            $users->where('membership_id', '=', $post['membership_id']);

            if ( ! empty($post['signup_date_after']))
            {
                $users->where('signup_date', '>=', strtotime($post['signup_date_after']));
            }

            if ( ! empty($post['signup_date_before']))
            {
                $users->where('signup_date', '<', strtotime($post['signup_date_before']));
            }

            if ( ! empty($post['country_id']))
            {
                $users->where('country_id', '=', $post['country_id']);
            }

            if ( ! empty($post['region_id']))
            {
                $users->where('region_id', '=', $post['region_id']);
            }

            if ( ! empty($post['city_id']))
            {
                $users->where('city_id', '=', $post['city_id']);
            }

            if ( ! empty($post['gender']))
            {
                $users->where('gender', '=', $post['gender']);
            }

            if ( ! empty($post['interested_in']))
            {
                $users->where('interested_in', '=', $post['interested_in']);
            }

            if ( ! empty($post['startid']))
            {
                $users->where('id', '>=', $post['startid']);
            }

            if ($post['action'] == 'count')
            {
                $count = $users->count_all();
            }
            else
            {
            	//echo 'not done yet';
            	//exit();
                    $from = ORM::factory('user', array('username' => $user));

                    $users = $users->find_all();
                    $count = 0;

                    foreach($users as $to)
                    {
                        if ($from->id != $to->id)
                        {
                            $message_type = ORM::factory('message_type', array('type' => 'Photo Request'));
                            $message = ORM::factory('message');

                            $sent_today = $message->where('to_id', '=', $to)
                                ->where('from_id', '=', $from)
                                ->where('message_type_id', '=', $message_type)
                                ->where('date_sent', '>=', strtotime('est now -1 month'))
                                ->where('date_sent', '<=', strtotime('est now'))
                                ->count_all();

                            if ($sent_today >= 1)
                            {
                                continue;
                            }

                            ORM::factory('view')->update($to, $from);

                            $message->to_id = $to;
                            $message->from_id = $from;
                            $message->message_type_id = $message_type;
                            $message->subject = $from->username . ' has a request';
                            //$message->message = Text::auto_p(Functions::template_replace($template->message, $from, $to));

							if ( ! empty($to->avatar_id))
					        {
					            $message->message = Functions::template_replace('|from| has expressed interest in seeing additional photos added to your account.', $from, $to);
					        }
					        else
					        {
					            $message->message = Functions::template_replace('|from| has expressed interest in seeing photos added to your account.', $from, $to);
					        }

                            $message->save();
                            $count++;

                            Functions::send_request($to, $from);
                            //Mailer::factory('user')->send_flirt($from, $to);
                        }
                    }

                    Notify::set('pass', 'Your pic request was successfully sent to ' . $count . ' users');

                    Request::instance()->redirect('admin/blast/request/' . $user);
            }
        }
    }
}