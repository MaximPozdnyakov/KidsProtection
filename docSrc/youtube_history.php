<?php
/**
 * @api {get} /api/youtube_history/:child/:channel 1. Получить историю посещений youtube для указанного ребенка и канала
 * @apiName GetYoutubeHistory
 * @apiGroup YoutubeHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * channel - Название канала или ссылка на него.
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[youtube_history]} Success Массив с историей посещения youtube
 * @apiSuccessExample {json} Success 200:
 * /api/youtube_history/1/maxkatz1
 * [
 *     {
 *         "id": 2,
 *         "channel": "maxkatz1",
 *         "locked": "0",
 *         "user": "1",
 *         "date": "06.09.2021 19:13",
 *         "created_at": "2021-09-08T08:11:00.000000Z",
 *         "updated_at": "2021-09-08T08:11:00.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/youtube_history 2. Добавить историю посещения youtube
 * @apiName PostYoutubeHistory
 * @apiGroup YoutubeHistory
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} channel Идентификатор канала или ссылка на него. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 * @apiParam {String} date Дата посещения канала в формате d.m.Y H:i. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "channel": "maxkatz1",
 *     "user": "1",
 *     "date": "06.09.2021 19:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "channel": [
 *            "Параметр channel обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Youtube канал не найден в списке youtube каналов ребенка
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Youtube канала не существует в списке youtube каналов указанного ребенка",
 * }
 *
 * @apiSuccess (Success 200) Success История посещения youtube и сообщение о ее создании
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История посещения youtube канала добавлена",
 *     "data": {
 *         "id": 2,
 *         "channel": "maxkatz1",
 *         "locked": "0",
 *         "user": "1",
 *         "date": "06.09.2021 19:13",
 *         "created_at": "2021-09-08T08:11:00.000000Z",
 *         "updated_at": "2021-09-08T08:11:00.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /api/youtube_history/:child/:channel/:date 3. Получить список посещений youtube для указанного ребенка по дате
 * @apiName GetYoutubeHistoryByDate
 * @apiGroup YoutubeHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * channel - Идентификатор канала или ссылка на него;
 * date - дата посещения youtube в формате d.m.Y
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 400) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "Параметр date должен быть датой формата d.m.Y",
 * }
 *
 * @apiSuccess (Success 200) {Array[youtube_history]} Success Массив с историей посещения youtube канала в указанный день
 * @apiSuccessExample {json} Success 200:
 * /api/youtube_history/1/maxkatz1/06.09.2021
 * [
 *     {
 *         "id": 2,
 *         "channel": "maxkatz1",
 *         "locked": "0",
 *         "user": "1",
 *         "date": "06.09.2021 19:13",
 *         "created_at": "2021-09-08T08:11:00.000000Z",
 *         "updated_at": "2021-09-08T08:11:00.000000Z"
 *     }
 * ]
 */

/**
 * @api {delete} /api/youtube_history/:youtube_history 4. Удалить историю посещения youtube канала
 * @apiName DeleteYoutubeHistory
 * @apiGroup YoutubeHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription youtube_history - Id истории посещения youtube канала
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound История посещения youtube канала не найдена
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти историю посещения youtube канала с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит история посещения youtube канала |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить историю посещения youtube канала, не принадлежащую ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Эта история посещения youtube канала не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении истории посещения youtube канала
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История посещения youtube канала была удалена"
 * }
 */
