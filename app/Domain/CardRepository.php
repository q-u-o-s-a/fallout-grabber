<?php

namespace FalloutGrabber;

class CardRepository
{
    private array $assets;
    private array $missionLinks;
    private array $playerTokens;
    private array $cardBack;
    private string $urlPrefix;
    private array $token;

    public function __construct() {

        $this->urlPrefix = 'http://cloud-3.steamusercontent.com/ugc/';

        $this->cardBack = [
            0 => ['1037464359655797687/AE2D7A34A0C6FE201341DBF9D390657108D3DA35/',
                'AE2D7A34A0C6FE201341DBF9D390657108D3DA35_card_unique_back.png'],
            1 => ['1037464359655805710/48571930ADC28849DB91153C229086621F3C6774/',
                '48571930ADC28849DB91153C229086621F3C6774_card_loot_back.png'],
            2 => ['1037464359655810617/4B43819D6B8A7E5B89F13A7913F71B47D4CE90B3/',
                '4B43819D6B8A7E5B89F13A7913F71B47D4CE90B3_card_asset_back.png'],
            3 => ['1037464359655810617/4B43819D6B8A7E5B89F13A7913F71B47D4CE90B3/',
                '4B43819D6B8A7E5B89F13A7913F71B47D4CE90B3_card_asset_back.png'],
            4 => ['1037464359655832528/A42B17F6158F1EC2BF9CC06B8464B9744E07478D/',
                'A42B17F6158F1EC2BF9CC06B8464B9744E07478D_card_wasteland_back.png'],
            5 => ['1037464359655835124/57A199680C3C3A5B5B5D8E5FC690480A09835DEB/',
                '57A199680C3C3A5B5B5D8E5FC690480A09835DEB_card_settlement_back.png'],
            6 => ['1664605116696844300/2DBF4EABF30C2E03A1008ED6872A5946E14425FB/',
                '2DBF4EABF30C2E03A1008ED6872A5946E14425FB_fallout_ab_activiation_back.jpg'],
            7 => ['1664605116696848213/49CA705610F7FCE70A054EBB9ADCBAD16E0CA8C9/',
                '49CA705610F7FCE70A054EBB9ADCBAD16E0CA8C9_fallout_ab_goals_back.jpg'],
            8 => ['1664605116696850573/93B204757ABE156E5C9BF0D276A3642733A4DFE1/',
                '93B204757ABE156E5C9BF0D276A3642733A4DFE1_fallout_ab_modifications_back.jpg'],
            9 => ['1664605116696852763/CD62C7992B6222DB71423566E29B647D17E7182C/',
                'CD62C7992B6222DB71423566E29B647D17E7182C_fallout_ab_workshop_back.jpg'],
            10 => ['1664605116696856406/1CA66F7558088054465086AA883075AF280A0021/',
                '1CA66F7558088054465086AA883075AF280A0021_fallout_ab_mutation_back.jpg'],
            11 => ['1037464359655817983/C6B0B100B7E4CB92D05B3252EF4F819A65485985/',
                'C6B0B100B7E4CB92D05B3252EF4F819A65485985_card_agenda_back.png'],
            12 => ['1037464359655844951/3591AD6C13932104867834AC06AB6D9AE7734D2E/',
                '3591AD6C13932104867834AC06AB6D9AE7734D2E_card_quest_back.png'],
            13 => ['1037464359655822876/957902F7747BF6A3D3F9F0D2C6B380BD48859558/',
                '957902F7747BF6A3D3F9F0D2C6B380BD48859558_card_vault84_back.png'],
            14 => ['1037464359655826261/CE07415E3CE0B1F0D6EFD93C96CB0590FBC6561D/',
                'CE07415E3CE0B1F0D6EFD93C96CB0590FBC6561D_card_vault109_back.png'],
        ];

        $this->token = [
            0 => ['1037464359655863270/85A151D0588B8E4239A3DD448FBF8155F31BECF7/',
                '85A151D0588B8E4239A3DD448FBF8155F31BECF7_token_faction1_power.png'],
            1 => ['1037464359655868126/2FEE933C5008F3E6A58CDDFC43DB0F7C577C5BAE/',
                '2FEE933C5008F3E6A58CDDFC43DB0F7C577C5BAE_token_faction2_power.png'],
            2 => ['1037464359655899275/F25C513EC58F01A997E0541243299D157876A23E/',
                'F25C513EC58F01A997E0541243299D157876A23E_token_trait1.png'],
            3 => ['1037464359655899708/4D7DEDC603A1BF748425D90308BEDC2E2F93A00D/',
                '4D7DEDC603A1BF748425D90308BEDC2E2F93A00D_token_trait1_back.png'],
            4 => ['1037464359655902739/4216B8B49B41AC11E584D1BF3845769A613DF554/',
                '4216B8B49B41AC11E584D1BF3845769A613DF554_token_trait2.png'],
            5 => ['1037464359655903219/DD37FAF26C48CA74674698FDDBC33C5ECD6DD0AD/',
                'DD37FAF26C48CA74674698FDDBC33C5ECD6DD0AD_token_trait2_back.png'],
            6 => ['1037464359655907691/1E248DE67DED6A4C6109C9C5D634E67843D22A7E/',
                '1E248DE67DED6A4C6109C9C5D634E67843D22A7E_token_trait3.png'],
            7 => ['1037464359655908078/892105BC1CB8486B29727780999AC75B131CCDC1/',
                '892105BC1CB8486B29727780999AC75B131CCDC1_token_trait3_back.png'],
            8 => ['1664605116696837985/93C6BC8E010DB72E967A7C6DFFC14518F8415CF5/',
                '93C6BC8E010DB72E967A7C6DFFC14518F8415CF5_fallout_ab_token_star.png'],
            9 => ['1664605116696838454/6650BA61887381D3814E245D977289F22FF9C65A/',
                '6650BA61887381D3814E245D977289F22FF9C65A_fallout_ab_token_shield.png'],
            10 => ['1037464359655869652/777B2362483BD8735B121CA9FF43793B7906EDF4/',
                '777B2362483BD8735B121CA9FF43793B7906EDF4_token_faction2_marker.png'],
            11 => ['1037464359655858753/97ADBD5549E4B5B9E32F94E22A47F3E031A6D7FF/',
                '97ADBD5549E4B5B9E32F94E22A47F3E031A6D7FF_token_faction1_marker.png'],
            12 => ['1664605116696859250/5216053FFE2997E1C7ABBD3B00F849EE28B616AB/',
                '5216053FFE2997E1C7ABBD3B00F849EE28B616AB_fallout_ab_CAMPtoken.png'],
            13 => ['1037464359655913408/01F2652A7AD09CDAE2B387B96AA1A50731B6F015/',
                '01F2652A7AD09CDAE2B387B96AA1A50731B6F015_token_quest_blue.png'],
            14 => ['1037464359655916382/E9D0F876F0C05642354E0A8D5DD5338527FC8B48/',
                'E9D0F876F0C05642354E0A8D5DD5338527FC8B48_token_quest_yellow.png'],
            15 => ['1248008787334771510/1904802B6E7F7DFF7DF5AFA5D11E223DB918FBE5/',
                '1904802B6E7F7DFF7DF5AFA5D11E223DB918FBE5_green-quest.png'],
            16 => ['1248008787334773159/410DAB2EF7D2C47A954BAC78FE9179315F096BA0/',
                '410DAB2EF7D2C47A954BAC78FE9179315F096BA0_purple-quest.png'],
            17 => ['1248008787334774020/606B30D15691733EE4D92EEA221AF1A68E65ADE7/',
                '606B30D15691733EE4D92EEA221AF1A68E65ADE7_red-quest.png'],
        ];

        //HALT AN 39381

        $this->playerTokens = [
            'Ghoul Token' => [
                ['1037464359655541006/A7FBBB50C79AC798B4D26510CEBB7757288BBF21/',
                    'A7FBBB50C79AC798B4D26510CEBB7757288BBF21_char_ghoul_token_back.png'],
                ['1037464359655526324/8DA95CABEB668ABA065A24196DD0B5D8505425F8/',
                    '8DA95CABEB668ABA065A24196DD0B5D8505425F8_token_P.png']],
            'Brotherhood Outcast Token' => [
                ['1037464359655545390/9424FAF94803ABEC54D59885048FCFEA75817A61/',
                    '9424FAF94803ABEC54D59885048FCFEA75817A61_char_powerarmor_token_back.png'],
                ['1037464359655528792/7CAA8BE95832B8C18087BD86FD159F5D6319B5DF/',
                    '7CAA8BE95832B8C18087BD86FD159F5D6319B5DF_token_I.png']],
            'Super Mutant Token' => [
                ['1037464359655543044/F0BA69C15B2A7987A294F019B7D319CEFC7D9CCA/',
                    'F0BA69C15B2A7987A294F019B7D319CEFC7D9CCA_char_mutant_token_back.png'],
                ['1037464359655521108/51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0/',
                    '51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0_token_S.png']],
            'Vault Dweller Token' => [
                ['1037464359655554578/5EBD32B9118FE3BCC18B559707D34D3C0D64FAE8/',
                    '5EBD32B9118FE3BCC18B559707D34D3C0D64FAE8_char_vaultdweller_token_back.png'],
                ['1037464359655521108/51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0/',
                    '51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0_token_S.png']],
            'Wastelander Token' => [
                ['1037464359655556164/0B87595B8F4CEDE85291DFF15FB9FB676D1C535D/',
                    '0B87595B8F4CEDE85291DFF15FB9FB676D1C535D_char_wastelander_token_back.png'],
                ['1037464359655529527/C28E39B90C79F4A6E9FB58D46034F2AF2897BD18/',
                    'C28E39B90C79F4A6E9FB58D46034F2AF2897BD18_token_A.png']],
            'Ghoul Card' => [
                ['1037464359655554578/5EBD32B9118FE3BCC18B559707D34D3C0D64FAE8/',
                    '5EBD32B9118FE3BCC18B559707D34D3C0D64FAE8_char_vaultdweller_token_back.png'],
                ['1037464359655521108/51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0/',
                    '51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0_token_S.png']],
            'Enclave Deserter' => [
                ['1248008787331736826/C947C6AE8346DD495786AE076B17A8032CE2DD08/',
                    'C947C6AE8346DD495786AE076B17A8032CE2DD08_char_enclave_token_back.jpg'],
                ['1037464359655521108/51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0/',
                    '51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0_token_S.png']],
            'Gunslinger' => [
                ['1248008787331739851/AB2C835E7577E293547E2A1ACC2F390A5F5F1DD9/',
                    'AB2C835E7577E293547E2A1ACC2F390A5F5F1DD9_char_gunslinger_token_back.jpg'],
                ['1037464359655530467/ADD8822839CA912C5AA03B437CB1349420431D37/',
                    'ADD8822839CA912C5AA03B437CB1349420431D37_token_L.png']],
            'Mr. Handy' => [
                ['1248008787331748121/2F5D6BD019717E4C99C68E3E20608DECD8431CD9/',
                    '2F5D6BD019717E4C99C68E3E20608DECD8431CD9_char_handy_token_back.jpg'],
                ['1037464359655527225/C4081A1B87C7B9F4C560E484B7D23D5F68A0AFBE/',
                    'C4081A1B87C7B9F4C560E484B7D23D5F68A0AFBE_token_E.png']],
            'Merchant' => [
                ['1248008787331741592/C1FBC168597FA9F6869F7FAB05CBF0BBBA874E56/',
                    'C1FBC168597FA9F6869F7FAB05CBF0BBBA874E56_char_merchant_token_back.jpg'],
                ['1037464359655527225/5A9A3B9E2FFAB29599163845A66D525461640DC3/',
                    '5A9A3B9E2FFAB29599163845A66D525461640DC3_token_C.png']],
            'RNK Ranger' => [
                ['1248008787331732773/7C47ACAFE7FDBCE902F1D3F15FCEBDC334280C93/',
                    '7C47ACAFE7FDBCE902F1D3F15FCEBDC334280C93_char_ranger_token_back.jpg'],
                ['1037464359655527225/8DA95CABEB668ABA065A24196DD0B5D8505425F8/',
                    '8DA95CABEB668ABA065A24196DD0B5D8505425F8_token_P.png']],
            'SPECIAL S' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655521108/51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0/',
                    '51A0A0C2562EB4612F4C2C754D0E1AC62576A0F0_token_S.png']],
            'SPECIAL P' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655526324/8DA95CABEB668ABA065A24196DD0B5D8505425F8/',
                    '8DA95CABEB668ABA065A24196DD0B5D8505425F8_token_P.png']],
            'SPECIAL E' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655527225/C4081A1B87C7B9F4C560E484B7D23D5F68A0AFBE/',
                    'C4081A1B87C7B9F4C560E484B7D23D5F68A0AFBE_token_E.png']],
            'SPECIAL C' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655527928/5A9A3B9E2FFAB29599163845A66D525461640DC3/',
                    '5A9A3B9E2FFAB29599163845A66D525461640DC3_token_C.png']],
            'SPECIAL I' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655528792/7CAA8BE95832B8C18087BD86FD159F5D6319B5DF/',
                    '7CAA8BE95832B8C18087BD86FD159F5D6319B5DF_token_I.png']],
            'SPECIAL A' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655529527/C28E39B90C79F4A6E9FB58D46034F2AF2897BD18/',
                    'C28E39B90C79F4A6E9FB58D46034F2AF2897BD18_token_A.png']],
            'SPECIAL L' => [
                ['1037464359655520193/45E23E1087F723CCBB660D90E25654EE7772421D/',
                    '45E23E1087F723CCBB660D90E25654EE7772421D_token_special_back.png'],
                ['1037464359655530467/ADD8822839CA912C5AA03B437CB1349420431D37/',
                    'ADD8822839CA912C5AA03B437CB1349420431D37_token_L.png']],

        ];

        $this->missions = [
            0 => ['1664605116696825953/DECA4BC648638BCE4A49E1D2DACBA6BD5C320161/',
                'DECA4BC648638BCE4A49E1D2DACBA6BD5C320161_fallout_ab_master_back.jpg'],
            1 => ['1664605116696825617/DC77DDFD678CE2E9DBF4EEFCA5B718209251F504/',
                'DC77DDFD678CE2E9DBF4EEFCA5B718209251F504_fallout_ab_master.jpg'],
            2 => ['1664605116696823886/47FCEBBE656DC3E764EE043B8FA3BCE25CFA05F5/',
                '47FCEBBE656DC3E764EE043B8FA3BCE25CFA05F5_fallout_ab_farharbor.jpg'],
            3 => ['1664605116696824082/BA2B92DA7C75627EFE05E0BA2F60EE411E687782/',
                'BA2B92DA7C75627EFE05E0BA2F60EE411E687782_fallout_ab_farharbor_back.jpg'],
            4 => ['1664605116696828933/8A88E3B84936046A3B04BB15309489345C187734/',
                '8A88E3B84936046A3B04BB15309489345C187734_fallout_ab_pitt.jpg'],
            5 => ['1664605116696829190/AABD0BC38F1CCCE9F8071B022D1DB3CFD9CE68B7/',
                'AABD0BC38F1CCCE9F8071B022D1DB3CFD9CE68B7_fallout_ab_pitt_back.jpg'],
            6 => ['1664605116696818098/54CB4AE7E2414EE093196B16C8E677F079603D3A/',
                '54CB4AE7E2414EE093196B16C8E677F079603D3A_fallout_ab_cp.jpg'],
            7 => ['1664605116696818335/4C515D149F92E529087B220D1B6734271C766439/',
                '4C515D149F92E529087B220D1B6734271C766439_fallout_ab_cp_back.jpg'],
            8 => ['1664605116696822001/15FE93CD14CEC3721E37C8A3540166F225E03B9C/',
                '15FE93CD14CEC3721E37C8A3540166F225E03B9C_fallout_ab_comm.jpg'],
            9 => ['1664605116696822184/2A30322149A9C4AC928590BBB83EB3207E71058E/',
                '2A30322149A9C4AC928590BBB83EB3207E71058E_fallout_ab_comm_back.jpg'],
            10 => ['1037464359655351121/BACD8BF018D5C5828B0B65AAAA05C184B9668B78/',
                'BACD8BF018D5C5828B0B65AAAA05C184B9668B78_scenarioa_farharbor_map.jpg'],
            11 => ['1037464359655351548/1E8D2C2A9A44C843A311FDCF43475759E0A3AFB4/',
                '1E8D2C2A9A44C843A311FDCF43475759E0A3AFB4_scenario_farharbor_back.jpg'],
            12 => ['1037464359655361927/8C26DA5B00563954D3C3191AE8B90FC783A32A3E/',
                '8C26DA5B00563954D3C3191AE8B90FC783A32A3E_scenario_thepitt_map.jpg'],
            13 => ['1037464359655362362/F1CDA6DF6B44A0BE1372188B76091EB3B103E6AF/',
                'F1CDA6DF6B44A0BE1372188B76091EB3B103E6AF_scenario_thepitt_back.jpg'],
            14 => ['1037464359655357031/DE306D1629B456D093C077A7A054C336285809D5/',
                'DE306D1629B456D093C077A7A054C336285809D5_scenario_capital_map.jpg'],
            15 => ['1037464359655356572/C63F5B2055C43250821E8149DEFF785792E9ED30/',
                'C63F5B2055C43250821E8149DEFF785792E9ED30_scenario_capital_back.jpg'],
            16 => ['1037464359655360586/B62958262ACCDFE1E73C5CB4B22E8231ACC48863/',
                'B62958262ACCDFE1E73C5CB4B22E8231ACC48863_scenario_commonwealth_map.jpg'],
            17 => ['1037464359655361040/D710303D5E5725295D6E3709FAE12CEA220CF0EE/',
                'D710303D5E5725295D6E3709FAE12CEA220CF0EE_scenario_commonwealth_back.jpg'],
            18 => ['1664605116696617954/96215437647E8E3AFDF40C4FEB550752464C4DF3/',
                '96215437647E8E3AFDF40C4FEB550752464C4DF3_fallout_nc_comm.jpg'],
            19 => ['1664605116696618182/EC7C5445857FEB305D5A45332B2284133FFFC988/',
                'EC7C5445857FEB305D5A45332B2284133FFFC988_fallout_nc_comm_back.jpg'],
            20 => ['1664605116696628424/F3F04DD406B9CA862441A245709BC89E44C63968/',
                'F3F04DD406B9CA862441A245709BC89E44C63968_fallout_nc_nc.jpg'],
            21 => ['1664605116696628760/409BE97F60CF3AFAF5155E8AC7417ADF3F2D545E/',
                '409BE97F60CF3AFAF5155E8AC7417ADF3F2D545E_fallout_nc_nc_back.jpg'],
            22 => ['1664605116696626631/7E44284B4A9C058F7B30389B018A295027C90BC4/',
                '7E44284B4A9C058F7B30389B018A295027C90BC4_fallout_nc_master.jpg'],
            23 => ['1664605116696626854/1D481F1B7135D2D7CF970BD1C55E9C37E61F2795/',
                '1D481F1B7135D2D7CF970BD1C55E9C37E61F2795_fallout_nc_master_back.jpg'],
            24 => ['1664605116696625048/4F9330C6E03E4E854049DD2917200659C5E885C7/',
                '4F9330C6E03E4E854049DD2917200659C5E885C7_fallout_nc_harbor.jpg'],
            25 => ['1664605116696625248/FD2F6F60DA8118DDBFA33349AD1960AF4C5ACC18/',
                'FD2F6F60DA8118DDBFA33349AD1960AF4C5ACC18_fallout_nc_harbor_back.jpg'],
            26 => ['1664605116696622700/91A57F03DA5CF4D0016CC63D38FBADC3015615C8/',
                '91A57F03DA5CF4D0016CC63D38FBADC3015615C8_fallout_nc_cp.jpg'],
            27 => ['1664605116696622909/05C458A737B143ECD7E67BA6022BE9868AD46F4F/',
                '05C458A737B143ECD7E67BA6022BE9868AD46F4F_fallout_nc_cp_back.jpg'],
            28 => ['1664605116696630806/1E023D1DE161306263BDC6510F058B83E46DA3DF/',
                '1E023D1DE161306263BDC6510F058B83E46DA3DF_fallout_nc_pitt.jpg'],
            29 => ['1664605116696631006/9AD425453463AF322E700D61D53554D5A833C940/',
                '9AD425453463AF322E700D61D53554D5A833C940_fallout_nc_pitt_back.jpg'],
        ];

        $this->missionLinks = [
            0 => ['fallout_ab_cover',
                '1648842893711427346/0693072CA44C87663FD215C6DD3053142FDAC142/',
                '0693072CA44C87663FD215C6DD3053142FDAC142_fallout_ab_cover_R.jpg'],
            1 => ['fallout_nc_cover',
                '1648842893711427346/0693072CA44C87663FD215C6DD3053142FDAC142/',
                'CCC08BD3E447382AD18D51032B52064F0A1541B4_fallout_nc_cover_R.jpg'],
            2 => ['fallout_og_cover',
                '1648842893711475060/C6AE22D34895F7814C1E23936A92F6DBF6DCDF5E/',
                'C6AE22D34895F7814C1E23936A92F6DBF6DCDF5E_fallout_og_cover_R.jpg'],
            3 => ['fallout_commonwealth',
                '1648842893711475060/C6AE22D34895F7814C1E23936A92F6DBF6DCDF5E/',
                'FD3C8BBBAB0EDA224CE3A327695068D18DA96F09_fallout_commonwealth.jpg'],
            4 => ['fallout_capital_wasteland',
                '1648842893711645840/4230D8418FEB8583B36A6D43CFA43E4B748B6DBE/',
                '4230D8418FEB8583B36A6D43CFA43E4B748B6DBE_fallout_capital_wasteland.jpg'],
            5 => ['fallout_pitt',
                '1648842893711645840/4230D8418FEB8583B36A6D43CFA43E4B748B6DBE/',
                'BD2A0F2FDA671FA61D781CBC46D23A7BD3FBD16C_fallout_pitt.jpg'],
            6 => ['fallout_harbor',
                '1648842893711647657/7BB7439E3DD4C1D525208689CDC01D4EAA04834F/',
                '7BB7439E3DD4C1D525208689CDC01D4EAA04834F_fallout_harbor.jpg'],
            7 => ['fallout_harbor_nc',
                '1648842893711672110/C4E4FFADA782DAF4FCF52BEE9E588C6056DB7485/',
                'C4E4FFADA782DAF4FCF52BEE9E588C6056DB7485_fallout_harbor_nc.jpg'],
            8 => ['fallout_capital_wasteland_nc',
                '1648842893711673510/ED69E64C391561FEDCC5EA9B2B21AFA24E41F5DC/',
                'ED69E64C391561FEDCC5EA9B2B21AFA24E41F5DC_fallout_capital_wasteland_nc.jpg'],
            9 => ['fallout_commonwealth_nc',
                '1648842893711674646/0EA906C34D4E8632172D26A2904340EEFD1F168B/',
                '0EA906C34D4E8632172D26A2904340EEFD1F168B_fallout_commonwealth_nc.jpg'],
            10 => ['fallout_master',
                '1648842893711675930/F5BA3ADF04D2C72C715F1A4C91B31A2A909D945D/',
                'F5BA3ADF04D2C72C715F1A4C91B31A2A909D945D_fallout_master.jpg'],
            11 => ['fallout_california',
                '1648842893711677376/52A8171AD44B76A47882A89E36753AD5A66B0238/',
                '52A8171AD44B76A47882A89E36753AD5A66B0238_fallout_california.jpg'],
            12 => ['fallout_pitt_nc',
                '1648842893711678224/A6C46A4BA52CCC8054477D4E8D99AC3876281190/',
                'A6C46A4BA52CCC8054477D4E8D99AC3876281190_fallout_pitt_nc.jpg'],
            13 => ['fallout_capital_wasteland_ab',
                '1648842893711695013/EEED6B9971B8DBD3ABA9CF340EB57739841A254C/',
                'EEED6B9971B8DBD3ABA9CF340EB57739841A254C_fallout_capital_wasteland_ab.jpg'],
            14 => ['fallout_commonwealth_ab',
                '1648842893711696100/A373926942ADF0D23FEDDAC60C6D43E5FFB45B6A/',
                'A373926942ADF0D23FEDDAC60C6D43E5FFB45B6A_fallout_commonwealth_ab.jpg'],
            15 => ['fallout_harbor_ab',
                '1648842893711696871/35B327B0E3AAC73190A423BE9B350FB7D65B4AAC/',
                '35B327B0E3AAC73190A423BE9B350FB7D65B4AAC_fallout_harbor_ab.jpg'],
            16 => ['fallout_master_ab',
                '1648842893711697764/1649C814B2BBC9C57954E51AB4F6EFDCC6B12A10/',
                '1649C814B2BBC9C57954E51AB4F6EFDCC6B12A10_fallout_master_ab.jpg'],
            17 => ['fallout_pitt_ab',
                '1648842893711699015/A4F4B47F731C13FE745B92990C2A929649CF9967/',
                'A4F4B47F731C13FE745B92990C2A929649CF9967_fallout_pitt_ab.jpg'],
            18 => ['railroad_R',
                '1648843044115884321/7D30D6F29DEC55F6554E093CA8EF3E15E3C4C7F9/',
                '7D30D6F29DEC55F6554E093CA8EF3E15E3C4C7F9_railroad_R.jpg'],
            19 => ['institute_R',
                '1648843044115886778/29C28B8D9EF8880C90219AAD52B5821C467C215C/',
                '29C28B8D9EF8880C90219AAD52B5821C467C215C_institute_R.jpg'],
            20 => ['brotherhood_R',
                '1648843044115894846/79A35A76160E5F423D75CC863989070FB5187179/',
                '79A35A76160E5F423D75CC863989070FB5187179_brotherhood_R.jpg'],
            21 => ['enclave_R',
                '1648843044115895496/3716021894AB7B6E86792A75DCEF09AA4AC2ECAB/',
                '3716021894AB7B6E86792A75DCEF09AA4AC2ECAB_enclave_R.jpg'],
            22 => ['rebels_R',
                '1648843044115913769/21DC5D30C8F64366BF13C37F3C369D30DF2FD845/',
                '21DC5D30C8F64366BF13C37F3C369D30DF2FD845_rebels_R.jpg'],
            23 => ['slavers_R',
                '1648843044115914505/E2F61EAADD4E5175A8498779DD3C1D085B3ABA41/',
                'E2F61EAADD4E5175A8498779DD3C1D085B3ABA41_slavers_R.jpg'],
            24 => ['childrenatom',
                '1648843044115915694/B308F74C07E2A43546476759A47E46F61EF9ED86/',
                'B308F74C07E2A43546476759A47E46F61EF9ED86_childrenatom.jpg'],
            25 => ['farharbor_R',
                '1648843044115916386/3620F1AC7E11A2E93688817391A5E7B3CCC1AE26/',
                '3620F1AC7E11A2E93688817391A5E7B3CCC1AE26_farharbor_R.jpg'],
            26 => ['unity_R',
                '1648843044115917287/10041EA122927C742CF6B276AE3FDA7B924EF5C0/',
                '10041EA122927C742CF6B276AE3FDA7B924EF5C0_unity_R.jpg'],
        ];

        $this->assets = [
            0 => [1045, 670, "1037464359655831758/4677CEF82901E6161F75A7D56CDDBB88E42FD633/", 34, 10, 'png',
                "Names" => ['001', '002', '003', '004', '006', '012', '017', '022', '027', '046', '047', '053', '063',
                    '100', '105', '106', '110', '122', '123', '124', '127', '135', '140', '144', '145', '156',
                    'S01', 'S02', 'S03', 'S04', 'S05','S06', 'S07', 'S08'],
                "4677CEF82901E6161F75A7D56CDDBB88E42FD633_card_wasteland.jpg", "card_wasteland"],
            1 => [1045, 673, "1037464359655834794/1846C8FF8522D2687CE91C9CAAC58B231E9FBECF/", 21, 10, 'png',
                "Names" => ['005', '007', '008', '009', '010', '011', '013', '026', '031', '038', '103', '129', '154',
                    'S09', 'S10', 'S11', 'S12', 'S13', 'S14', 'S15', 'S16'],
                "1846C8FF8522D2687CE91C9CAAC58B231E9FBECF_card_settlement.jpg", "card_settlement"],
            2 => [523, 338, "1248008787334683255/EE083B674F749CB65C8598EBA81CE1AE51C7EBA7/", 8, 5, 'jpeg',
                "Names" => ['S17', 'S18', 'S19', 'S20', 'S21', 'S22', 'S23', 'S24'],
                "EE083B674F749CB65C8598EBA81CE1AE51C7EBA7_nc_wasteland_starter.jpg", "nc_wasteland_starter"],
            3 => [523, 337, "1248008787334604371/9E1800110064EC05CCA8F5BA1C5E89EB884588EB/", 8, 5, 'jpeg',
                "Names" => ['S25', 'S26', 'S27', 'S28', 'S29', 'S30', 'S31', 'S32'],
                "9E1800110064EC05CCA8F5BA1C5E89EB884588EB_nc_settlement_starter.jpg", "nc_settlement_starter"],
            4 => [1045, 666, "1037464359655844410/526BB9949B36D774B71CBAA0B71BA2910693915A/", 39, 10, 'png',
                "Names" => ['014', '015', '016', '018', '019', '020', '021', '023', '024', '025', '028', '029', '030', '032', '033',
                    '034', '035', '036', '037', '039', '040', '041', '042', '043', '044', '045', '048', '049', '050', '051', '052',
                    '054', '055', '056', '057', '058', '059', '060', '061'],
                "526BB9949B36D774B71CBAA0B71BA2910693915A_card_quests1.jpg", "card_quests1"],
            5 => [1045, 671, "1037464359655849151/1D79F1455334E46295FE7F4CD191EFA97ECD892E/", 61, 10, 'jpeg',
                "Names" => ['062', '064', '065', '066', '067', '068', '069', '082', '083', '084', '085', '094', '095', '096', '097',
                    '098', '099', '101', '102', '104', '107', '108', '109', '111', '112', '113', '114', '115', '116', '117', '118',
                    '119', '120', '121', '125', '126', '128', '130', '131', '132', '133', '134', '136', '137', '138', '139', '141',
                    '142', '143', '146', '147', '148', '149', '150', '151', '152', '153', '155', '157', '158', '159'],
                "1D79F1455334E46295FE7F4CD191EFA97ECD892E_card_quests2.jpg", "card_quests2"],
            6 => [1045, 670, "1037464359655822424/B5C496D82A0F3F7A1E05F913F320AB274550D09F/", 12, 10, 'png',
                "Names" => ['070','071','072','073','074','075','076','077','078','079','080','081'],
                "B5C496D82A0F3F7A1E05F913F320AB274550D09F_card_vault84.png", "card_vault84"],
            7 => [1045, 669, "1037464359655825845/1B862C377774AECB3675E79D8A752F4DCF6E4206/", 8, 10, 'png',
                "Names" => ['086','087','088','089','090','091','092','093'],
                "1B862C377774AECB3675E79D8A752F4DCF6E4206_card_vault109.png", "card_vault109"],
            8 => [1045, 669, "1248008787334589110/8F98EA20710F87C8696A14CBBC52A2294E205E48/", 14, 10, 'jpeg',
                "Names" => ['161','163','164','165','228','229','241A','241B','243A','243B','244A','244B','244C'],
                "8F98EA20710F87C8696A14CBBC52A2294E205E48_nc_settlement.jpg", "nc_settlement"],
            9 => [1045, 669, "1248008787334707674/E1A609B557AB0A3A7D43FD3B4E4BB9018362C4B9/", 17, 10, 'jpeg',
                "Names" => ['162','168','171','191','215','216','222','224','227','231','235','239','240A', '240B','240C','240D', '242'],
                "E1A609B557AB0A3A7D43FD3B4E4BB9018362C4B9_nc_wasteland.jpg", "nc_wasteland"],
            10 => [376, 246, "1248008787334640640/6036DA0F25052E1DC6A66EF4A8D6101CF92AF7B5/", 8, 8, 'jpeg',
                "Names" => [],
                "6036DA0F25052E1DC6A66EF4A8D6101CF92AF7B5_nc_unique_assets.jpg", "nc_unique_assets"],
            11 => [374, 246, "1248008787334656721/5D39A74BD698DD14345228257A557B10B86B0B92/", 21, 10, 'jpeg',
                "Names" => [],
                "5D39A74BD698DD14345228257A557B10B86B0B92_nc_assets.jpg", "nc_assets"],
            12 => [244, 376, "1248008787334579444/3356103D9E49CBFEEBB8E5ECD7BEDF9F55AECBF3/", 7, 4, 'jpeg',
                "Names" => [],
                "3356103D9E49CBFEEBB8E5ECD7BEDF9F55AECBF3_nc_perks.jpg", "nc_perks"],
            13 => [485, 748, "1248008787334579675/0B6C86DFCBE60518A8F29845DA776FEBB3104097/", 7, 4, 'jpeg',
                "Names" => [],
                "0B6C86DFCBE60518A8F29845DA776FEBB3104097_nc_perk_backs.jpg", "nc_perk_backs"],
            14 => [999, 648, "1664605116696847986/21EB01455FEA3BFC0FFC3D5866FED7A26E09D821/", 12, 8, 'jpeg',
                "Names" => [],
                "21EB01455FEA3BFC0FFC3D5866FED7A26E09D821_fallout_ab_goals.jpg", "fallout_ab_goals"],
            15 => [999, 648, "1664605116696850203/64EDBA13A8E2148CD4DBFE9E988FDEC8A1929793/", 14, 8, 'jpeg',
                "Names" => [],
                "64EDBA13A8E2148CD4DBFE9E988FDEC8A1929793_fallout_ab_modifications.jpg", "fallout_ab_modifications"],
            16 => [999, 648, "1664605116696852517/68D85686FEAC121B6CE2C1A1B6BC524F16D34471/", 12, 8, 'jpeg',
                "Names" => [],
                "68D85686FEAC121B6CE2C1A1B6BC524F16D34471_fallout_ab_workshop.jpg", "fallout_ab_workshop"],
            17 => [999, 648, "1664605116696856175/C1839A0F43EAEB3D773DA818B4CE164583F3FB0A/", 14, 8, 'jpeg',
                "Names" => [],
                "C1839A0F43EAEB3D773DA818B4CE164583F3FB0A_fallout_ab_mutation.jpg", "fallout_ab_mutation"],
            18 => [374, 246, "1248008787331976660/5496D694B8472EBA285A1DFBBB39B7BC97C77FE9/", 6, 6, 'png',
                "Names" => [],
                "5496D694B8472EBA285A1DFBBB39B7BC97C77FE9_char_card_nc.jpg", "char_card_nc"],
            19 => [374, 246, "1248008787331976835/C0991207A4622230EACA40081D0A2B71131E0D0E/", 6, 6, 'png',
                "Names" => [],
                "C0991207A4622230EACA40081D0A2B71131E0D0E_char_card_back_nc.png", "char_card_back_nc"],
            20 => [748, 487, "1037464359655570036/3428D1FD878B6BE5E9BC644A0D8E3515A4D2D26E/", 5, 10, 'png',
                "Names" => [],
                "3428D1FD878B6BE5E9BC644A0D8E3515A4D2D26E_char_cards.png", "char_cards",],
            21 => [748, 489, "1037464359655570829/2001F075279398DF4C034B399174F84597D7041B/", 5, 10, 'png',
                "Names" => [],
                "2001F075279398DF4C034B399174F84597D7041B_char_cards_back.png", "char_cards_back",],
            22 => [486, 749, "1037464359655750231/F3D22583F73C5477EB304CDE52DE483969AF6319/", 14, 10, 'png',
                "Names" => [],
                "F3D22583F73C5477EB304CDE52DE483969AF6319_card_perks.png", "card_perks",],
            23 => [486, 749, "1037464359655751014/653EA9BAAD5C247B6CE2E2223AC51211E5683B27/", 14, 10, 'png',
                "Names" => [],
                "653EA9BAAD5C247B6CE2E2223AC51211E5683B27_card_perk_backs.png", "card_perk_backs",],
            24 => [999, 648, "1664605116696844079/B860A71AFADB4614561D39E088792695B43260EE/", 8, 8, 'jpeg',
                "Names" => [],
                "B860A71AFADB4614561D39E088792695B43260EE_fallout_ab_activation.jpg", "fallout_ab_activation"],
            25 => [748, 488, "1037464359655817406/CC54B7C11FC8731882BD2A1359276E866C0D98CE/", 23, 10, 'png',
                "Names" => [],
                "CC54B7C11FC8731882BD2A1359276E866C0D98CE_card_agenda.png", "card_agenda"],
            26 => [748, 489, "1037464359655797097/38ED10B48430E9C46BAB9C8908FCBD8C931A9CE3/", 11, 10, 'png',
                "Names" => ['Alien Blaster', 'Dogmeat', 'Fat man', 'Wasteland Survival Guide', 'Minigun', 'Pip-Boy',
                    'Shishkebab', 'Mysterious Stranger', 'Super Sledge', 'T-60 Power Armor', 'T-60E Power Armor'],
                "38ED10B48430E9C46BAB9C8908FCBD8C931A9CE3_card_unique.jpg", "card_unique"],
            27 => [748, 487, "1037464359655805062/9A24C6A5386A7DDFFFBDF6F390281734A45AFE44/", 34, 10, 'png',
                "Names" => ['Astoundingly Awesome Tales', 'Brahmin Steam', 'Buffout', 'Calmex', 'Pipe Wrench',
                    'Codsworth', 'Covert Ops Training', 'Day Tripper', 'Eyebot', 'Grognok The Barbarian',
                    'Guns & Bullets', 'Hancock', 'Unstoppables', 'Combat Knife', 'Kaser Rifle', 'Live & Love',
                    'Mentats', 'Metal Armor', 'Piper', 'Pipe Rifle', 'Preston Garvey', 'Psycho', 'Raider Armor',
                    'Tesla Science', 'Fistful of caps', 'Fistful of caps', 'Fistful of caps', 'Fistful of caps',
                    'Junk', 'Junk', 'Junk', 'Junk', 'Water', 'Water'],
                "9A24C6A5386A7DDFFFBDF6F390281734A45AFE44_card_loot.jpg", "card_loot"],
            28 => [748, 489, "1037464359655810160/E3FBDBE5FD93C0FDFA6BDD0583591C4F3102D1E3/", 25, 10, 'png',
                "Names" => [],
                "E3FBDBE5FD93C0FDFA6BDD0583591C4F3102D1E3_card_asset.jpg", "card_asset"],
            29 => [378, 250, "1248008787334631981/749F9210413DE5B646A972002E7A51BBFC5D715E/", 26, 10, 'jpeg',
                "Names" => [],
                "749F9210413DE5B646A972002E7A51BBFC5D715E_nc_loot.jpg", "nc_loot"],
        ];

    }

    public function getStoryCardArray(): array {
        $storyCard = [];
        for ($i = 0; $i <=9; $i++){
            foreach ($this->assets[$i]['Names'] as $key => $name) {
                $storyCard[$name] = [$this->assets[$i][7] => $key, $this->assets[$i][4]];
            }
        }
        ksort($storyCard);
        return $storyCard;
    }

    /**
     * @return array[]
     */
    public function getAssets(): array {
        return $this->assets;
    }

    /**
     * @return array|false
     */
    public function getAssetCardTypes() {
        foreach ($this->assets as $asset) {
            $result[] = $asset[7];
        }
        if (isset($result)) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @return array|false
     */
    public function getAsset($set) {
        foreach ($this->assets as $asset) {
            if ((string)$asset[7] == (string)$set) {
                return $asset;
            }
        }
        return false;
    }

    public function getAssetNrByAssetName($set) {
        foreach ($this->assets as $key => $asset) {
            if ((string)$asset[7] == (string)$set) {
                return $key;
            }
        }
        return false;
    }

    public function getUrlPrefix(): string {
        return $this->urlPrefix;
    }
}