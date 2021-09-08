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
 *     "terms_agree": "0",
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
 * @apiErrorExample {json} Bad request 400:
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
 *                  "id": 1,
 *                  "fio": "Максим Поздняков",
 *                  "email": "maximpozdnyakow@gmail.com",
 *                  "terms_agree": "0",
 *                  "email_verified": "1",
 *                  "created_at": "2021-09-05T11:58:04.000000Z",
 *                  "updated_at": "2021-09-07T13:30:05.000000Z"
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

 * @apiParamExample {json} Request:
 * {
 *     "email": "maximpozdnyakow@gmail.com",
 *     "password": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
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
 *                  "id": 1,
 *                  "fio": "Максим Поздняков",
 *                  "email": "maximpozdnyakow@gmail.com",
 *                  "terms_agree": "0",
 *                  "email_verified": "1",
 *                  "created_at": "2021-09-05T11:58:04.000000Z",
 *                  "updated_at": "2021-09-07T13:30:05.000000Z"
 *             }
 *         }
 *     }
 */

/**
 * @api {get} /api/users/logout 4. Выйти из аккаунта
 * @apiName LogoutUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) Success Сообщение о выходе
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Вы вышли из аккаунта"
 * }
 */

/**
 * @api {post} /api/users/forgot 5. Запрос на отправку кода для сброса пароля
 * @apiName ForgotUserPassword
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} email Валидный email существующего пользователя. Обязательный.
 * @apiParamExample {json} Request:
 * {
 *     "email": "maximpozdnyakow@gmail.com"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Веденный вами электронный адрес не связан ни с одним аккаунтом"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Сообщение об отправке шестизначного кода для сброса пароля
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Код для сброса пароля отправлен на вашу электронную почту"
 * }
 */

/**
 * @api {post} /api/users/reset 6. Сброс пароля
 * @apiName RestUserPassword
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} token Шестизначный код для сброса пароля. Обязательный.
 * @apiParam {String} password Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.
 * @apiParamExample {json} Request:
 * {
 *     "token": "396402",
 *     "password": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "token": [
 *                "Веденный вами код для сброса пароля недействителен"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 202) Success Сообщение о успешном изменении пароля
 * @apiSuccessExample {json} Success 202:
 * {
 *     "message": "Ваш пароль был успешно изменен"
 * }
 */

/**
 * @api {patch} /api/users 7. Обновление данных пользователя
 * @apiName UpdateUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiParam {String} fio Новое ФИО пользователя.
 * @apiParam {String} email Новый валидный email пользователя. Должен быть уникальным. После обновления email, на него присылается код для подтверждения email.
 * @apiParam {String} password Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру.
 *
 * @apiParamExample {json} Request:
 * {
 *     "fio": "Максим Поздняков",
 *     "email": "maxim@gmail.com",
 *     "password": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Пользователь с такими email уже существует"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 202) Success Пользователь и сообщение о успешном обновлении данных пользователя
 * @apiSuccessExample {json} Success 202:
 * {
 *     "message": Настройки профиля обновлены.",
 *     "data": {
 *         "id": 1,
 *         "fio": "Максим Поздняков",
 *         "email": "maxim@gmail.com",
 *         "terms_agree": "0",
 *         "email_verified": "1",
 *         "created_at": "2021-09-05T11:58:04.000000Z",
 *         "updated_at": "2021-09-07T13:30:05.000000Z"
 *     }
 * }
 */

/**
 * @api {post} /api/users/verify 8. Подтверждение email
 * @apiName VerifyUserEmail
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} token Шестизначный код для подтверждения email. Обязательный.
 * @apiParamExample {json} Request:
 * {
 *     "token": "396402"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "token": [
 *                "Веденный вами код для подтверждения email недействителен"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 202) Success Сообщение о успешном подтверждении email
 * @apiSuccessExample {json} Success 202:
 * {
 *     "message": "Ваша электронная почта была подтверждена"
 * }
 */
