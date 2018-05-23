# logcat

Parse and pretty-print logs written with [LogstashFormatter](https://github.com/Seldaek/monolog/blob/master/doc/02-handlers-formatters-processors.md#formatters) so

```
{"@timestamp":"2017-10-18T19:22:04.735006+02:00","@source":"vmprocess2","@fields":{"channel":"vmprocess2/worker/25425/worker/0","level":100,"process_id":25425},"@message":"all plugins failed","@tags":["vmprocess2/worker/25425/worker/0"],"@type":"worker"}
{"@timestamp":"2017-10-18T19:22:04.748418+02:00","@source":"vmprocess2","@fields":{"channel":"vmprocess2/worker/25425/worker/0","level":100,"process_id":25425,"ctxt_url":"//www.example.com/help","ctxt_date":"2017-08-31T22:00:00+00:00"},"@message":"fixed //www.example.com/help @ 2017-08-31T22:00:00+00:00","@tags":["vmprocess2/worker/25425/worker/0"],"@type":"worker"}
{"@timestamp":"2017-10-18T19:22:04.753206+02:00","@source":"vmprocess2","@fields":{"channel":"vmprocess2/worker/25425/worker/0","level":100,"process_id":25425,"ctxt_url":"//www.example.com/whatsapp/","ctxt_date":"[object] (MongoDB\\BSON\\UTCDateTime: {\"$date\":{\"$numberLong\":\"1504216800000\"}})"},"@message":"working on //www.example.com/whatsapp/","@tags":["vmprocess2/worker/25425/worker/0"],"@type":"worker"}
{"@timestamp":"2017-10-18T19:22:04.756272+02:00","@source":"vmprocess2","@fields":{"channel":"vmprocess2/worker/25425/worker/0","level":100,"process_id":25425},"@message":"all plugins failed","@tags":["vmprocess2/worker/25425/worker/0"],"@type":"worker"}
{"@timestamp":"2017-10-18T19:22:04.773755+02:00","@source":"vmprocess2","@fields":{"channel":"vmprocess2/worker/25425/worker/0","level":100,"process_id":25425,"ctxt_url":"//www.example.com/whatsapp/","ctxt_date":"2017-08-31T22:00:00+00:00"},"@message":"fixed //www.example.com/whatsapp/ @ 2017-08-31T22:00:00+00:00","@tags":["vmprocess2/worker/25425/worker/0"],"@type":"worker"}
```

becomes

![Screenshot](https://github.com/thesebas/logcat/raw/assets/screen.png)

