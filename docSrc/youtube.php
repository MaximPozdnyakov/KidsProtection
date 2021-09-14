<?php
/**
 * @api {get} /youtube/blocked 1. Получить список заблокированных youtube каналов указанного ребенка
 * @apiName GetYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 *     { "child": "1" }
 *
 * @apiSuccess (Success 200) {Array[Youtubes]} Success Список заблокированных youtube каналов
 * @apiSuccessExample {json} Success 200:
 * [
 *     "NakeyJakey",
 *     "BeatEmUps"
 * ]
 */

/**
 * @api {post} /api/youtube/blocked 2. Заблокировать youtube канал
 * @apiName PostYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} channel Идентификатор канала или ссылка на него. Должен быть уникальным для ребенка. Обязательный. Нельзя добавить идентификатор канала и ссылку, относящиеся к одному каналу. К примеру, если в базе уже создана сущность с channel=https://www.youtube.com/c/maxkatz1 , то при добавлении сущности с channel=maxkatz1 , метод выдаст ошибку.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "channel": "NakeyJakey",
 *     "child": "1"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "channel": [
 *            "Параметр channel обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о блокировании youtube канала
 * @apiSuccessExample {json} Success 200:
 * "Youtube канал заблокирован"
 */

/**
 * @api {delete} /api/youtube/blocked 3. Разблокировать youtube канал
 * @apiName DeleteYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound youtube канал не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * "Не удалось найти youtube канал"
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} Youtube Заблокированный youtube канал
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "channel": "NakeyJakey"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об разблокировки youtube канала
 * @apiSuccessExample {json} Success 200:
 * "Youtube канал разблокирован"
 */
