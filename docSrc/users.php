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
 * @api {post} /api/users/register Регистрация
 * @apiName RegisterUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiError (Error 400) {String} name_required Параметр name обязателен
 * @apiError (Error 400) {String} email_required Параметр email обязателен
 * @apiError (Error 400) {String} email_email Email не корректен
 * @apiError (Error 400) {String} email_unique Пользователь с такими email уже существует
 * @apiError (Error 400) {String} password_require Параметр password обязателен
 * @apiError (Error 400) {String} password_format Пароль должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру
 *
 * @apiErrorExample {json} Error 400:
 *     HTTP/1.1 400 Bad Request
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "name": [
 *                "Укажите ФИО",
 *            ],
 *            "email": [
 *                "Укажите email",
 *                "Укажите корректный email",
 *                "Пользователь с такими email уже существует"
 *            ],
 *            "password": [
 *                "Укажите пароль",
 *                "Пароль должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру",
 *            ],
 *        }
 *     }
 *
 * @apiSuccess (Success 201) {Object} user Новый пользователь
 * @apiSuccess (Success 201) {String} user.id Id пользователя
 * @apiSuccess (Success 201) {String} user.name Имя пользователя
 * @apiSuccess (Success 201) {String} user.email Email пользователя
 * @apiSuccess (Success 201) {String} user.created_at Дата создания пользователя
 * @apiSuccess (Success 201) {String} user.updated_at Дата обновления пользователя
 * @apiSuccess (Success 201) {String} message Сообщение о создании пользователя
 * @apiSuccess (Success 201) {String} token Токен авторизации
 *
 * @apiSuccessExample {json} Success 201:
 *     HTTP/1.1 201 Created
 *     {
 *         "message": "Вы успешно зарегистрировались",
 *         "data": {
 *             "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9",
 *             "user": {
 *                 "id": 2
 *                 "name": "Максим Поздняков Алексеевич",
 *                 "email": "maximpozdnyakow@gmail.com",
 *                 "created_at": "2021-09-01T15:35:04.000000Z",
 *                 "updated_at": "2021-09-01T15:35:04.000000Z",
 *             }
 *         }
 *     }
 *
 * @apiParam {String} name ФИО пользователя
 * @apiParam {String} email Email пользователя
 * @apiParam {String} password Пароль пользователя
 *
 * @apiParamExample {json} Request:
 * {
 *     "name": "Максим Поздняков Алексеевич",
 *     "email": "maximpozdnyakow@gmail.com",
 *     "password": "SDGsdfn735F"
 * }
 */

/**
 * @api {post} /api/users/login Авторизация
 * @apiName LoginUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiError (Error 400) {String} email_required Параметр email обязателен
 * @apiError (Error 400) {String} email_email Email не корректен
 * @apiError (Error 400) {String} user_does_not_exist Email не связан ни с одним аккаунтом
 * @apiError (Error 400) {String} password_required Параметр password обязателен
 * @apiError (Error 400) {String} password_wrong Пароль неверный
 *
 * @apiErrorExample {json} Error 400:
 *     HTTP/1.1 400 Bad Request
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Укажите email",
 *                "Укажите корректный email",
 *                "Веденный вами электронный адрес не связан ни с одним аккаунтом"
 *            ],
 *            "password": [
 *                "Укажите пароль",
 *                "Вы ввели неверный пароль",
 *            ],
 *        }
 *     }
 */
