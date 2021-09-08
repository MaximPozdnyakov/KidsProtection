<?php
/**
 * @api {get} /api/applications/:child 1. Получить список приложений указанного ребенка
 * @apiName GetApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[applications]} Success Массив приложений
 * @apiSuccessExample {json} Success 200:
 * /api/applications/1
 * [
 *     {
 *         "id": 1,
 *         "package": "whatsapp",
 *         "name": "Whatsapp",
 *         "image": "data:image/png;base64,iVBORw0KG ...",
 *         "locked": "0",
 *         "start_dt": null,
 *         "end_dt": null,
 *         "parent": "1",
 *         "user": "1",
 *         "created_at": "2021-09-08T13:14:56.000000Z",
 *         "updated_at": "2021-09-08T13:14:56.000000Z"
 *     },
 * ]
 */

/**
 * @api {post} /api/applications 2. Добавить приложение
 * @apiName PostApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} package Идентификатор приложения. Должен быть уникальным для ребенка. Обязательный.
 * @apiParam {File} image Изображение приложения в формате png, jpg или svg. Обязательный.
 * @apiParam {String} name Наименование приложения. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *    "package": "whatsapp",
 *    "name": WhatsApp,
 *    "user": "1",
 *    "image": Иконка WhatsApp
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
 * @apiSuccess (Success 200) Success Приложение и сообщение о его добавлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Мобильное приложение добавлено",
 *     "data": {
 *         "id": 1,
 *         "package": "whatsapp",
 *         "name": "Whatsapp",
 *         "image": "data:image/png;base64,iVBORw0KG ...",
 *         "locked": "0",
 *         "start_dt": null,
 *         "end_dt": null,
 *         "parent": "1",
 *         "user": "1",
 *         "created_at": "2021-09-08T13:14:56.000000Z",
 *         "updated_at": "2021-09-08T13:14:56.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /api/applications/:child/:application 3. Получить приложение
 * @apiName GetApplicationById
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * application - Id приложения
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Object} Success Приложение
 * @apiSuccessExample {json} Success 200:
 * /api/applications/1/1
 * {
 *     "id": 1,
 *     "package": "whatsapp",
 *     "name": "Whatsapp",
 *     "image": "data:image/png;base64,iVBORw0KG ...",
 *     "locked": "0",
 *     "start_dt": null,
 *     "end_dt": null,
 *     "parent": "1",
 *     "user": "1",
 *     "created_at": "2021-09-08T13:14:56.000000Z",
 *     "updated_at": "2021-09-08T13:14:56.000000Z"
 * }
 */

/**
 * @api {post} /api/applications/:application 4. Обновить настройки приложения
 * @apiName UpdateApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription application - Id приложения
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Приложение не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти приложение с указанным id",
 * }
 *
 * @apiParam {File} image Изображение приложения в формате png, jpg или svg.
 * @apiParam {String} name Наименование приложения.
 * @apiParam {Boolean} locked Является ли приложение заблокированным.
 * @apiParam {String|null} start_dt Время начала доступа к приложениеу в формате d.m.Y H:i.
 * @apiParam {String|null} end_dt Время конца доступа к приложениеу в формате d.m.Y H:i.
 *
 * @apiParamExample {json} Request:
 * {
 *     "locked": true,
 *     "start_dt": null,
 *     "end_dt": "07.09.2021 19:13"
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит приложение |
 *
 * @apiSuccess (Success 200) Success Приложение и сообщение о его обновлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Настройки приложения обновлены",
 *     "data": {
 *          "id": 1,
 *          "package": "whatsapp",
 *          "name": "Whatsapp",
 *          "image": "data:image/png;base64,iVBORw0KG...",
 *          "locked": "1",
 *          "start_dt": null,
 *          "end_dt": "07.09.2021 19:13",
 *          "parent": "1",
 *          "user": "1",
 *          "created_at": "2021-09-08T13:14:56.000000Z",
 *          "updated_at": "2021-09-08T13:14:56.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /api/applications/:application 5. Удалить приложение
 * @apiName DeleteApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription application - Id приложения
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Приложение не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти приложений с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит приложение |
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении приложения
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Приложение удален"
 * }
 */
