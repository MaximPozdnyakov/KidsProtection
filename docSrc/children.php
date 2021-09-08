<?php

/**
 * @api {get} /api/children 1. Получить список детей
 * @apiName GetChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[children]} Success Список детей авторизированного пользователя. Их число ограничено текущей подпиской. К примеру, у пользователя была подключена подписка с 5 устройствами, и он зарегистрировал 5 детей. Но потом она истекла, и он подключил подписку дешевле, на 3 устройства. Тогда этот метод вернет первых трех детей из пяти.
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 1,
 *         "name": "Юля",
 *         "date": "05.09.2010",
 *         "parent": "1",
 *         "block_all_apps": "0",
 *         "block_all_phones": "0",
 *         "block_all_site": "0",
 *         "block_all_youtube": "0",
 *         "created_at": "2021-09-05T12:09:56.000000Z",
 *         "updated_at": "2021-09-05T12:09:56.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/children 2. Добавить ребенка
 * @apiName PostChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiParam {String} name Имя ребенка. Обязательный.
 * @apiParam {String} date День рождения ребенка в формате d.m.Y. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "name": "Юля",
 *     "date": "05.09.2010"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "name": [
 *            "Параметр name обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Devices Limit Reached 403) BadRequest Возникает при попытке добавить больше устройств, чем позволяет подписка
 * @apiErrorExample {json} Devices Limit Reached 403:
 * {
 *    "message": "Вам можно подключить не более 3 устройств",
 * }
 *
 * @apiSuccess (Success 200) Success Новый ребенок и сообщение о его создании
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Ребенок добавлен",
 *     "data": {
 *         "id": 1,
 *         "name": "Юля",
 *         "date": "05.09.2010",
 *         "parent": "1",
 *         "block_all_apps": "0",
 *         "block_all_phones": "0",
 *         "block_all_site": "0",
 *         "block_all_youtube": "0",
 *         "created_at": "2021-09-05T12:09:56.000000Z",
 *         "updated_at": "2021-09-05T12:09:56.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /children/:child 3. Получить ребенка
 * @apiName GetOneChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Object} Success Ребенок
 * @apiSuccessExample {json} Success 200:
 * /api/children/1
 * {
 *    "id": 1,
 *    "name": "Юля",
 *    "date": "05.09.2010",
 *    "parent": "1",
 *    "block_all_apps": "0",
 *    "block_all_phones": "0",
 *    "block_all_site": "0",
 *    "block_all_youtube": "0",
 *    "created_at": "2021-09-05T12:09:56.000000Z",
 *    "updated_at": "2021-09-05T12:09:56.000000Z"
 * }
 */

/**
 * @api {patch} /children/:child 4. Обновить настройки и данные ребенка
 * @apiName UpdateChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} name Имя ребенка.
 * @apiParam {String} date День рождения ребенка в формате d.m.Y.
 * @apiParam {Boolean} block_all_apps Нужно ли блокировать все приложении.
 * @apiParam {Boolean} block_all_phones Нужно ли блокировать все телефоны.
 * @apiParam {Boolean} block_all_site Нужно ли блокировать все сайты.
 * @apiParam {Boolean} block_all_youtube Нужно ли блокировать все youtube каналы.
 * @apiParamExample {json} Request:
 * {
 *     "name": "Антон",
 *     "date": "07.01.2012",
 *     "block_all_apps": true,
 *     "block_all_phones": true,
 *     "block_all_site": true,
 *     "block_all_youtube": true
 * }
 *
 * @apiSuccess (Success 202) Success Ребенок и сообщение о обновлении его данных
 * @apiSuccessExample {json} Success 202:
 * {
 *     "message": "Данные ребенка обновлены",
 *     "data": {
 *         "id": 2,
 *         "name": "Антон",
 *         "date": "07.01.2012",
 *         "parent": "1",
 *         "block_all_apps": true,
 *         "block_all_phones": true,
 *         "block_all_site": true,
 *         "block_all_youtube": true,
 *         "created_at": "2021-09-07T12:07:47.000000Z",
 *         "updated_at": "2021-09-08T10:25:20.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /children/:child 5. Удалить ребенка
 * @apiName DeleteChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении ребенка
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Ребенок удален"
 * }
 */
