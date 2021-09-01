<?php
/**
 * @apiDefine Authorization
 *
 * @apiPermission Авторизованный пользователь
 *
 * @apiHeader {String} Authorization Bearer $token
 * @apiHeaderExample {json} Header:
 *     { "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO" }
 *
 * @apiError (Error 401) {Object} Unauthenticated Не был предоставлен токен авторизации, или же он недействителен
 * @apiErrorExample {json} Error 401:
 *     HTTP/1.1 401 Unauthorized
 *     {
 *       "message": "Unauthenticated."
 *     }
 */

/**
 * @api {get} /api/children Получить список детей
 * @apiName GetChildren
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) {Object[child]} children Массив детей авторизированного пользователя
 * @apiSuccess (Success 200) {String} child.id Id ребенка
 * @apiSuccess (Success 200) {String} child.name Имя ребенка
 * @apiSuccess (Success 200) {String} child.year_of_birth Год рождения ребенка
 * @apiSuccess (Success 200) {String} child.parent_id Id родителя ребенка
 * @apiSuccess (Success 200) {String} child.created_at Дата создания ребенка
 * @apiSuccess (Success 200) {String} child.updated_at Дата обновления ребенка
 *
 * @apiSuccessExample {json} Success 200:
 *     HTTP/1.1 200 OK
 *     [
 *       {
 *          "id": 2,
 *          "name": "Дима",
 *          "year_of_birth": "2015",
 *          "parent_id": "1",
 *          "created_at": "2021-09-01T10:32:22.000000Z",
 *          "updated_at": "2021-09-01T10:32:22.000000Z"
 *       }
 *     ]
 */

/**
 * @api {post} /api/children Создать ребенка
 * @apiName StoreChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 * @apiUse Authorization
 *
 * @apiError (Error 400) {String} name_required Параметр name обязателен
 * @apiError (Error 400) {String} year_of_birth_required Параметр year_of_birth обязателен
 * @apiError (Error 400) {String} year_of_birth_numeric Параметр year_of_birth должен состоять из цифр
 *
 * @apiErrorExample {json} Error 400:
 *     HTTP/1.1 400 Bad Request
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "name": [
 *                "Укажите имя ребенка",
 *            ],
 *            "year_of_birth": [
 *                "Укажите год рождения ребенка",
 *                "Год рождения должен быть числом"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 201) {Object} data Новый ребенок
 * @apiSuccess (Success 201) {String} data.id Id ребенка
 * @apiSuccess (Success 201) {String} data.name Имя ребенка
 * @apiSuccess (Success 201) {String} data.year_of_birth Год рождения ребенка
 * @apiSuccess (Success 201) {String} data.parent_id Id родителя ребенка
 * @apiSuccess (Success 201) {String} data.created_at Дата создания ребенка
 * @apiSuccess (Success 201) {String} data.updated_at Дата обновления ребенка
 * @apiSuccess (Success 201) {String} message Сообщение о создании ребенка
 *
 * @apiSuccessExample {json} Success 201:
 *     HTTP/1.1 201 Created
 *     {
 *         "message": "Ребенок создан",
 *         "data": {
 *             "name": "Настя",
 *             "year_of_birth": "2014",
 *             "parent_id": 1,
 *             "updated_at": "2021-09-01T14:26:32.000000Z",
 *             "created_at": "2021-09-01T14:26:32.000000Z",
 *             "id": 3
 *         }
 *     }
 *
 * @apiParam {String} name Имя ребенка
 * @apiParam {String|Number} year_of_birth Год рождения ребенка
 * @apiParamExample {json} Request:
 *     {
 *         "name": "Настя",
 *         "year_of_birth": "2014"
 *     }
 */

/**
 * @api {delete} /api/children/:child Удалить ребенка
 * @apiName DeleteChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 * @apiUse Authorization
 *
 * @apiError (Error 403) {Object} Forbidden Ребенка с id :child либо не существует, либо он не принадлежит авторизированному пользователю
 *
 * @apiErrorExample {json} Error 403:
 *     HTTP/1.1 403 Forbidden
 *     {
 *         "message": "Forbidden",
 *         "errors": {
 *             "child": "Этот ребенок вам не принадлежит"
 *         }
 *     }
 *
 * @apiSuccess (Success 200) {String} message Сообщение об удалении ребенка
 * @apiSuccessExample {json} Success 200:
 *     HTTP/1.1 200 OK
 *     {
 *         "message": "Ребенок удален"
 *     }
 *
 * @apiQuery {String} child Id ребенка
 */
