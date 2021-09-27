<?php
/**
 * @api {post} /api/gps/story 2. Добавить местоположение ребенка
 * @apiName PostGeolocation
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} latitude Валидная широта. Обязательный.
 * @apiParam {String} longitude Валидная долгота. Обязательный.
 * @apiParam {String} address Адрес. Необязательный. По умолчанию null.
 * @apiParam {String} date Дата отправки геолокации в формате d.m.Y H:i. Обязательный.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 * "child": 1,
 * "gps": [
 *     {
 *         "date": "08.09.2021 13:33",
 *         "latitude": "52.2234234",
 *         "longitude": "33.1244433"
 *     },
 *     {
 *         "date": "08.09.2021 14:21",
 *         "latitude": "52.5534234",
 *         "longitude": "33.3344433"
 *     }
 * ]
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "gps.0.latitude": [
 *            "Параметр 0.latitude обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о добавлении геолокации
 * @apiSuccessExample {json} Success 200:
 * "Геолокация добавлена"
 */

/**
 * @api {get} /api/gps/story 1. Получить список местоположений для указанного ребенка по дате
 * @apiName GetGeolocationByDate
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} date Дата добавления геолокации в формате d.m.Y
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "date": "07.09.2021"
 * }
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 404) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 404:
 * "date должен быть датой формата d.m.Y"
 *
 * @apiSuccess (Success 200) {Array[geolocation]} Success Массив местоположений по указанной дате
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "latitude": "79.837271",
 *         "longitude": "30.312033",
 *         "address": "адрес",
 *         "date": "07.09.2021 17:13"
 *     },
 *     {
 *         "latitude": "69.837271",
 *         "longitude": "30.312033",
 *         "address": "адрес2",
 *         "date": "07.09.2021 18:13"
 *     }
 * ]
 */
