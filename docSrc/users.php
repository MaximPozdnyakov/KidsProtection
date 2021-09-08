<?php

/**
 * @api {get} /api/users 1. Получить авторизированного пользователя
 * @apiName GetUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) {Object} Success Авторизированный пользователь
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 1,
 *     "fio": "Максим Поздняков",
 *     "email": "maximpozdnyakow@gmail.com",
 *     "terms_agree": "1",
 *     "email_verified": "1",
 *     "created_at": "2021-09-05T11:58:04.000000Z",
 *     "updated_at": "2021-09-07T13:30:05.000000Z"
 * }
 */

/**
 * @api {post} /api/users/register 2. Регистрация
 * @apiName RegisterUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiDescription После успешной регистрации, на email пользователя отправляется код для подтверждения email.
 *
 * @apiParam {String} fio ФИО пользователя. Обязательный.
 * @apiParam {String} email Валидный email пользователя. Должен быть уникальным. Обязательный.
 * @apiParam {String} password Пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.
 * @apiParam {Boolean} terms_agree Согласен ли пользователь с условиями соглашения. Должен быть true. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "fio": "Максим Поздняков Алексеевич",
 *     "email": "maximpozdnyakow@gmail.com",
 *     "password": "SDGsdfn735F",
 *     "terms_agree": true
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Error 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "fio": [
 *                "Укажите ФИО"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 201) Success Новый пользователь, токен авторизации и сообщение о успешной регистрации
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
 */

/**
 * @api {post} /api/users/login 3. Авторизация
 * @apiName LoginUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} email Email пользователя. Обязательный.
 * @apiParam {String} password Пароль пользователя, соответствующий указанному email. Обязательный.
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Error 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Веденный вами электронный адрес не связан ни с одним аккаунтом"
 *            ],
 *            "password": [
 *                "Вы ввели неверный пароль"
 *            ],
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Пользователь, токен авторизации и сообщение о успешной авторизации
 * @apiSuccessExample {json} Success 200:
 *     {
 *         "message": "Вы успешно авторизовались",
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
 */
