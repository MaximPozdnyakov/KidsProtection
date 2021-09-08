<?php
/**
 * @api {get} /api/application_history/:child/:package 1. Получить историю использования приложения для указанного ребенка
 * @apiName GetApplicationHistory
 * @apiGroup ApplicationHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * package - Идентификатор приложения.
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[youtube_history]} Success Массив с историей использования приложения и изображение приложения
 * @apiSuccessExample {json} Success 200:
 * /api/youtube_history/1/whatsapp
 * {
 *     "data": {
 *         "history": [
 *             {
 *                 "id": 1,
 *                 "package": "whatsapp",
 *                 "name": "Whatsapp",
 *                 "locked": "0",
 *                 "start_dt": "07.09.2021 19:13",
 *                 "end_dt": "07.09.2021 20:13",
 *                 "user": "1",
 *                 "created_at": "2021-09-08T13:57:22.000000Z",
 *                 "updated_at": "2021-09-08T13:57:22.000000Z"
 *             }
 *         ],
 *         "image": "data:image/png;base64,iVBORw0KG..."
 *     }
 * }
 */

/**
 * @api {post} /api/youtube_history 2. Добавить историю использования приложения
 * @apiName PostApplicationHistory
 * @apiGroup ApplicationHistory
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} package Идентификатор канала или ссылка на него. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 * @apiParam {String} start_dt Дата начала использования приложения в формате d.m.Y H:i. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *    "package": "whatsapp",
 *    "user": "1",
 *    "start_dt": "07.09.2021 19:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "package": [
 *            "Параметр package обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Приложение не найдено в списке приложений ребенка
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Приложение не существует в списке приложений указанного ребенка",
 * }
 *
 * @apiSuccess (Success 200) Success История использования приложения и сообщение о ее создании
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История использования приложения добавлена",
 *     "data": {
 *         "id": 1,
 *         "package": "whatsapp",
 *         "name": "Whatsapp",
 *         "image": "data:image/png;base64,iVBORw0...",
 *         "locked": "0",
 *         "start_dt": "07.09.2021 19:13",
 *         "end_dt": null,
 *         "user": "1",
 *         "created_at": "2021-09-08T13:57:22.000000Z",
 *         "updated_at": "2021-09-08T13:57:22.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /api/youtube_history/:child/:package/:date 3. Получить историю использования приложения для указанного ребенка по дате
 * @apiName GetApplicationHistoryByDate
 * @apiGroup ApplicationHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * package - Идентификатор приложения;
 * date - дата использования приложения в формате d.m.Y
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
 * @apiSuccess (Success 200) {Array[youtube_history]} Success Массив с историей использования приложения в указанный день и изображение приложения
 * @apiSuccessExample {json} Success 200:
 * /api/youtube_history/1/whatsapp/07.09.2021
 * {
 *     "data": {
 *         "history": [
 *             {
 *                 "id": 1,
 *                 "package": "whatsapp",
 *                 "name": "Whatsapp",
 *                 "locked": "0",
 *                 "start_dt": "07.09.2021 19:13",
 *                 "end_dt": "07.09.2021 20:13",
 *                 "user": "1",
 *                 "created_at": "2021-09-08T13:57:22.000000Z",
 *                 "updated_at": "2021-09-08T13:57:22.000000Z"
 *             }
 *         ],
 *         "image": "data:image/png;base64,iVBORw0KG..."
 *     }
 * }
 */

/**
 * @api {patch} /api/youtube_history/:youtube_history 4. Обновить историю использования приложения
 * @apiName UpdateApplicationHistory
 * @apiGroup ApplicationHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription youtube_history - Id истории использования приложения
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} end_dt Дата окончания использования приложения в формате d.m.Y H:i.
 *
 * @apiParamExample {json} Request:
 * {
 *    "end_dt": "07.09.2021 20:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "end_dt": [
 *            "Параметр end_dt должен быть датой формата d.m.Y H:i"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Приложение не найдено в списке приложений ребенка
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Приложение не существует в списке приложений указанного ребенка",
 * }
 *
 * @apiSuccess (Success 200) Success История использования приложения и сообщение о ее обновлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История использования приложения обновлена",
 *     "data": {
 *         "id": 1,
 *         "package": "whatsapp",
 *         "name": "Whatsapp",
 *         "image": "data:image/png;base64,iVBORw0...",
 *         "locked": "0",
 *         "start_dt": "07.09.2021 19:13",
 *         "end_dt": "07.09.2021 20:13",
 *         "user": "1",
 *         "created_at": "2021-09-08T13:57:22.000000Z",
 *         "updated_at": "2021-09-08T13:57:22.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /api/youtube_history/:youtube_history 5. Удалить историю использования приложения
 * @apiName DeleteApplicationHistory
 * @apiGroup ApplicationHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription youtube_history - Id истории использования приложения
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound История использования приложения не найдена
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти историю использования приложения с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит история использования приложения |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить историю использования приложения, не принадлежащую ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Эта история использования приложения не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении истории использования приложения
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История использования приложения была удалена"
 * }
 */
