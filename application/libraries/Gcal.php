<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gcal
{

    // protected $_calendarId = 'online-test@gmail.com';
    // protected $_calendarId = 'c_t6htbu0jsd3f0jom31nrolcr88@group.calendar.google.com';

    function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Kalender Akademik');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(FCPATH . 'assets/api/client_secret_.json');

        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = FCPATH . 'assets/api/token_.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }
    function getList($_calendarId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $optParams = array(
            'maxResults' => 1000,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date(DATE_ISO8601, strtotime(date('Y-m-01 h:i:s'))),
            'timeMax' => date(DATE_ISO8601, strtotime(date("Y-n-j", strtotime("first day of next month"))))
        );
        $results = $service->events->listEvents($_calendarId, $optParams);

        return $results->getItems();
    }
    function insert($data, $_calendarId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event($data);
        $event = $service->events->insert($_calendarId, $event);
        return $event->getId();
    }
    function delete($id, $_calendarId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $service->events->delete($_calendarId, $id);
        return enkrip($_calendarId);
    }
    function update($id, $data, $_calendarId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event($data);
        return $service->events->update($_calendarId, $id, $event);
    }
    function drop($id, $start, $end, $allDay)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $event = $service->events->get($this->_calendarId, $id);
        if ($allDay == 1) {
            $event->start->setDate($start);
            $event->end->setDate($end);
        } else {
            $event->start->setDateTime($start);
            $event->end->setDateTime($end);
        }
        return $service->events->update($this->_calendarId, $event->getId(), $event);
    }
    function getS($_calendarId, $eventID)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $event = $service->events->get($_calendarId, $eventID);
        return array(
            [
                'title' => $event->getSummary(),
                'start' => $event->getStart()->getDate(),
                'end' => $event->getEnd()->getDate(),
                'location' => $event->getLocation(),
                'description' => $event->getDescription()
            ]

        );
    }
}

// [{
//   "id":"6elugkhrl96e9t0ueejeo420u1",
//   "title":"Cacak Etok",
//   "start":"2022-04-26T10:00:00+07:00",
//   "end":"2022-04-26T10:30:00+07:00",
//   "description":null,
//   "color":null,
//   "htmlLink":"https:\/\/www.google.com\/calendar\/event?eid=NmVsdWdraHJsOTZlOXQwdWVlamVvNDIwdTEgY190Nmh0YnUwanNkM2Ywam9tMzFucm9sY3I4OEBn"
// }]
//
// {"events":
//   [{
//     "kind":"calendar#event",
//     "etag":"\"3259958286838000\"",
//     "id":"20210101_agmof3m38ljnidh63keivistls",
//     "status":"confirmed",
//     "htmlLink":"https:\/\/www.google.com\/calendar\/event?eid=MjAyMTAxMDFfYWdtb2YzbTM4bGpuaWRoNjNrZWl2aXN0bHMgaWQuaW5kb25lc2lhbiNob2xpZGF5QHY",
//     "created":"2021-08-26T11:59:03.000Z",
//     "updated":"2021-08-26T11:59:03.419Z",
//     "summary":"Hari Tahun Baru",
//     "description":"Hari libur nasional",
//     "creator":{
//       "email":"id.indonesian#holiday@group.v.calendar.google.com",
//       "displayName":"Hari libur di Indonesia",
//       "self":true
//     },
//     "organizer":{
//       "email":"id.indonesian#holiday@group.v.calendar.google.com",
//       "displayName":"Hari libur di Indonesia",
//       "self":true
//     },
//     "start":{"date":"2021-01-01"},
//     "end":{"date":"2021-01-02"},
//     "transparency":"transparent",
//     "visibility":"public",
//     "iCalUID":"20210101_agmof3m38ljnidh63keivistls@google.com",
//     "sequence":0,
//     "eventType":"default"
//   }]
// }
