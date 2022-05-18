<?php

namespace FalloutGrabber;

class CardRepository
{
    private $assets;

    public function __construct() {

        $this->assets = [
            0 => [748, 489, "http://cloud-3.steamusercontent.com/ugc/1037464359655797097/38ED10B48430E9C46BAB9C8908FCBD8C931A9CE3/", 11, 10, 'png',
                "Names" => ['Alien Blaster', 'Dogmeat', 'Fat man', 'Wasteland Survival Guide', 'Minigun', 'Pip-Boy',
                    'Shishkebab', 'Mysterious Stranger', 'Super Sledge', 'T-60 Power Armor', 'T-60E Power Armor'],
                "38ED10B48430E9C46BAB9C8908FCBD8C931A9CE3_card_unique.png", "card_unique"],
            1 => [748, 487, "http://cloud-3.steamusercontent.com/ugc/1037464359655805062/9A24C6A5386A7DDFFFBDF6F390281734A45AFE44/", 34, 10, 'png',
                "Names" => [],
                "9A24C6A5386A7DDFFFBDF6F390281734A45AFE44_card_loot.png", "card_loot"],
            2 => [748, 489, "http://cloud-3.steamusercontent.com/ugc/1037464359655810160/E3FBDBE5FD93C0FDFA6BDD0583591C4F3102D1E3/", 25, 10, 'png',
                "Names" => [],
                "E3FBDBE5FD93C0FDFA6BDD0583591C4F3102D1E3_card_asset.png", "card_asset"],
            3 => [1045, 671, "http://cloud-3.steamusercontent.com/ugc/1037464359655831758/4677CEF82901E6161F75A7D56CDDBB88E42FD633/", 34, 10, 'png',
                "Names" => ['1', '2', '3', '4', '6', '12', '17', '22', '27', '46', '47', '53', '63', '100', '105',
                    '106', '110', '122', '123', '124', '127', '135', '140', '144', '145', '156', 'S1', 'S2', 'S3', 'S4', 'S5',
                    'S6', 'S7', 'S8'],
                "4677CEF82901E6161F75A7D56CDDBB88E42FD633_card_wasteland.png", "card_wasteland"],
            4 => [1045, 673, "http://cloud-3.steamusercontent.com/ugc/1037464359655834794/1846C8FF8522D2687CE91C9CAAC58B231E9FBECF/", 21, 10, 'png',
                "Names" => ['5', '7', '8', '9', '10', '11', '13', '26', '31', '38', '103', '129', '154', 'S9', 'S10', 'S11',
                    'S12', 'S13', 'S14', 'S15', 'S16'],
                "1846C8FF8522D2687CE91C9CAAC58B231E9FBECF_card_settlement.png", "card_settlement"],
            5 => [523, 338, "http://cloud-3.steamusercontent.com/ugc/1248008787334683255/EE083B674F749CB65C8598EBA81CE1AE51C7EBA7/", 8, 5, 'jpeg',
                "Names" => ['S17', 'S18', 'S19', 'S20', 'S21', 'S22', 'S23', 'S24'],
                "EE083B674F749CB65C8598EBA81CE1AE51C7EBA7_nc_wasteland_starter.jpg", "nc_wasteland_starter"],
            6 => [523, 337, "http://cloud-3.steamusercontent.com/ugc/1248008787334604371/9E1800110064EC05CCA8F5BA1C5E89EB884588EB/", 8, 5, 'jpeg',
                "Names" => ['S25', 'S26', 'S27', 'S28', 'S29', 'S30', 'S31', 'S32'],
                "9E1800110064EC05CCA8F5BA1C5E89EB884588EB_nc_settlement_starter.jpg", "nc_settlement_starter"],
            7 => [378, 250, "http://cloud-3.steamusercontent.com/ugc/1248008787334631981/749F9210413DE5B646A972002E7A51BBFC5D715E/", 26, 10, 'jpeg',
                "Names" => [],
                "749F9210413DE5B646A972002E7A51BBFC5D715E_nc_loot.jpg", "nc_loot"],
            8 => [376, 246, "http://cloud-3.steamusercontent.com/ugc/1248008787334640640/6036DA0F25052E1DC6A66EF4A8D6101CF92AF7B5/", 8, 8, 'jpeg',
                "Names" => [],
                "6036DA0F25052E1DC6A66EF4A8D6101CF92AF7B5_nc_unique_assets.jpg", "nc_unique_assets"],
            9 => [374, 246, "http://cloud-3.steamusercontent.com/ugc/1248008787334656721/5D39A74BD698DD14345228257A557B10B86B0B92/", 21, 10, 'jpeg',
                "Names" => [],
                "5D39A74BD698DD14345228257A557B10B86B0B92_nc_assets.jpg", "nc_assets"],
            10 => [244, 376, "http://cloud-3.steamusercontent.com/ugc/1248008787334579444/3356103D9E49CBFEEBB8E5ECD7BEDF9F55AECBF3/", 7, 4, 'jpeg',
                "Names" => [],
                "3356103D9E49CBFEEBB8E5ECD7BEDF9F55AECBF3_nc_perks.jpg", "nc_perks"],
            11 => [999, 648, "http://cloud-3.steamusercontent.com/ugc/1664605116696844079/B860A71AFADB4614561D39E088792695B43260EE/", 8, 8, 'jpeg',
                "Names" => [],
                "B860A71AFADB4614561D39E088792695B43260EE_fallout_ab_activation.jpg", "fallout_ab_activation"],
            12 => [999, 648, "http://cloud-3.steamusercontent.com/ugc/1664605116696847986/21EB01455FEA3BFC0FFC3D5866FED7A26E09D821/", 12, 8, 'jpeg',
                "Names" => [],
                "21EB01455FEA3BFC0FFC3D5866FED7A26E09D821_fallout_ab_goals.jpg", "fallout_ab_goals"],
            13 => [999, 648, "http://cloud-3.steamusercontent.com/ugc/1664605116696850203/64EDBA13A8E2148CD4DBFE9E988FDEC8A1929793/", 14, 8, 'jpeg',
                "Names" => [],
                "64EDBA13A8E2148CD4DBFE9E988FDEC8A1929793_fallout_ab_modifications.jpg", "fallout_ab_modifications"],
            14 => [999, 648, "http://cloud-3.steamusercontent.com/ugc/1664605116696852517/68D85686FEAC121B6CE2C1A1B6BC524F16D34471/", 12, 8, 'jpeg',
                "Names" => [],
                "68D85686FEAC121B6CE2C1A1B6BC524F16D34471_fallout_ab_workshop.jpg", "fallout_ab_workshop"],
            15 => [999, 648, "http://cloud-3.steamusercontent.com/ugc/1664605116696856175/C1839A0F43EAEB3D773DA818B4CE164583F3FB0A/", 14, 8, 'jpeg',
                "Names" => [],
                "C1839A0F43EAEB3D773DA818B4CE164583F3FB0A_fallout_ab_mutation.jpg", "fallout_ab_mutation"],
            16 => [374, 246, "http://cloud-3.steamusercontent.com/ugc/1248008787331976660/5496D694B8472EBA285A1DFBBB39B7BC97C77FE9/", 6, 6, 'png',
                "Names" => [],
                "5496D694B8472EBA285A1DFBBB39B7BC97C77FE9_char_card_nc.png", "char_card_nc"]
        ];

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
    public function getCardTypes() {
        foreach ($this->assets as $asset){
            $result[] = $asset[7];
        }
        if (isset($result)) {
            return $result;
        }else{
            return false;
        }
    }

    /**
     * @return array|false
     */
    public function getAsset($set) {
        foreach ($this->assets as $asset){
            if ((string)$asset[7]== (string) $set){
                return $asset;
            }
        }
        return false;
    }

    public function getAssetNrByAssetName($set) {
        foreach ($this->assets as $key =>$asset){
            if ((string)$asset[7]== (string) $set){
                return $key;
            }
        }
        return false;
    }
}