<?php

/**
 * @link https://github.com/zombiesg/Epic-Free-Games-PHP
 */
class EpicFreeGames
{
    private $LinkAPI = "https://store-site-backend-static.ak.epicgames.com/freeGamesPromotions";

    private function getJSON($country, $locale)
    {
        $curl = curl_init();
        $PostFields = http_build_query([
            'country' => $country,
            'locale' => $locale
        ]);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->LinkAPI,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $PostFields,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_FAILONERROR => true,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            return throw new Exception($error_msg);
        } else {
            return $response;
        }
    }

    private function processingJSON($rawData)
    {
        try {
            $data = $rawData->data->Catalog->searchStore->elements;
            $listNextWeek = array();
            $listCurrentWeek = array();

            foreach ($data as $item) {
                if (!empty($item->promotions)) {

                    //next week
                    if (!empty($item->promotions->upcomingPromotionalOffers[0])) {
                        $startDate = $item
                            ->promotions
                            ->upcomingPromotionalOffers[0]
                            ->promotionalOffers[0]
                            ->startDate;

                        $endDate = $item
                            ->promotions
                            ->upcomingPromotionalOffers[0]
                            ->promotionalOffers[0]
                            ->endDate;

                        if (
                            strtotime('now +1 week') > strtotime($startDate)
                            && strtotime('now +1 week') < strtotime($endDate)
                        ) {
                            array_push($listNextWeek, $item);
                        }
                    }

                    //this week
                    else {
                        $startDate = $item
                            ->promotions
                            ->promotionalOffers[0]
                            ->promotionalOffers[0]
                            ->startDate;
                        $endDate = $item
                            ->promotions
                            ->promotionalOffers[0]
                            ->promotionalOffers[0]
                            ->endDate;

                        if (
                            strtotime('now') > strtotime($startDate)
                            && strtotime('now') < strtotime($endDate)
                        ) {
                            array_push($listCurrentWeek, $item);
                        }
                    }
                }
            }
            return json_encode(array("currentGames" => $listCurrentWeek, "nextGames" => $listNextWeek), JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function getGames($country = "US", $locale = "en-US")
    {
        try {
            $tempRespond = $this->getJSON($country, $locale);
            $tempJSON = json_decode($tempRespond);
            if ($tempJSON === null && json_last_error() !== JSON_ERROR_NONE) {
                return throw new Exception(json_last_error());
            }
            return $this->processingJSON($tempJSON);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
//ignore
//https://stackoverflow.com/questions/70989379/php-curl-doesnt-send-post-params
//https://stackoverflow.com/questions/33302442/get-info-from-external-api-url-using-php