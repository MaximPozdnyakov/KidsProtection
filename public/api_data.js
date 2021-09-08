define({ "api": [
  {
    "type": "delete",
    "url": "/calls/:call",
    "title": "4. Удалить звонок",
    "name": "DeleteCall",
    "group": "Call",
    "version": "1.0.0",
    "description": "<p>call - Id звонка</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Звонок не найден</p>"
          }
        ],
        "Not belong to your child 403": [
          {
            "group": "Not belong to your child 403",
            "optional": false,
            "field": "NotBelongToYourChild",
            "description": "<p>Попытка удалить звонок, не принадлежащий ребенку родителя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти звонков с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Not belong to your child 403:",
          "content": "{\n  \"message\": \"Это звонков не принадлежит вашему ребенку\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит звонков |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении звонка</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Звонок было удалено\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/call.php",
    "groupTitle": "Call",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/calls/:call"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/calls/:child/:phone",
    "title": "1. Получить список звонков для указанного ребенка и телефона",
    "name": "GetCall",
    "group": "Call",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[calls]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком звонков</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/calls/1/79998887766\n[\n    {\n        \"id\": 2,\n        \"phone\": \"79998887766\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:54:42.000000Z\",\n        \"updated_at\": \"2021-09-07T16:54:42.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/call.php",
    "groupTitle": "Call",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/calls/:child/:phone"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/calls/:child/:phone/:date",
    "title": "3. Получить список звонков для указанного ребенка по дате",
    "name": "GetCallByDate",
    "group": "Call",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.; date - дата записи звонков в формате d.m.Y</p>",
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"Параметр date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[calls]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком звонков по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/calls/1/79998887766/05.09.2021\n[\n    {\n        \"id\": 7,\n        \"phone\": \"79998887766\",\n        \"msg\": \"Текст сообщения\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:26:52.000000Z\",\n        \"updated_at\": \"2021-09-07T16:26:52.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/call.php",
    "groupTitle": "Call",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/calls/:child/:phone/:date"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/calls",
    "title": "2. Добавить звонок",
    "name": "PostCall",
    "group": "Call",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "incoming",
            "description": "<p>Является ли звонок входящим. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата звонка в формате d.m.Y H:i. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"phone\": \"79998887766\",\n    \"incoming\": true,\n    \"date\": \"07.09.2021 17:13\",\n    \"user\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Телефон не найден в списке телефонов ребенка</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"phone\": [\n           \"Параметр phone обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Номер телефона 79998887766 не существует в списке номеров указанного ребенка\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Звонок с сообщением</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Звонок добавлен\",\n    \"data\": {\n        \"id\": 2,\n        \"phone\": \"79998887766\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:54:42.000000Z\",\n        \"updated_at\": \"2021-09-07T16:54:42.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/call.php",
    "groupTitle": "Call",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/calls"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/geolocation/:geolocation",
    "title": "4. Удалить геолокацию",
    "name": "DeleteGeolocation",
    "group": "Geolocation",
    "version": "1.0.0",
    "description": "<p>geolocation - Id геолокации</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Геолокация не найдена</p>"
          }
        ],
        "Not belong to your child 403": [
          {
            "group": "Not belong to your child 403",
            "optional": false,
            "field": "NotBelongToYourChild",
            "description": "<p>Попытка удалить геолокацию, не принадлежащую ребенку родителя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти геолокацию с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Not belong to your child 403:",
          "content": "{\n  \"message\": \"Эта геолокация не принадлежит вашему ребенку\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит геолокация |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении геолокации</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Геолокация была удалена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/geolocation/:geolocation"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/geolocation/:child",
    "title": "1. Получить список геолокаций для указанного ребенка",
    "name": "GetGeolocation",
    "group": "Geolocation",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[geolocation]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком геолокаций</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n   {\n       \"id\": 1,\n       \"latitude\": \"59.837271\",\n       \"longitude\": \"30.312033\",\n       \"address\": null,\n       \"date\": \"05.09.2021 17:40\",\n       \"user\": \"1\",\n       \"created_at\": \"2021-09-05T14:46:06.000000Z\",\n       \"updated_at\": \"2021-09-05T14:46:06.000000Z\"\n   },\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/geolocation/:child"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/geolocation/:child/:date",
    "title": "3. Получить список геолокация для указанного ребенка по дате",
    "name": "GetGeolocationByDate",
    "group": "Geolocation",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; date - дата записи геолокации в формате d.m.Y</p>",
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"Параметр date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[geolocation]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком геолокаций по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/geolocation/1/05.09.2021\n[\n   {\n       \"id\": 1,\n       \"latitude\": \"59.837271\",\n       \"longitude\": \"30.312033\",\n       \"address\": null,\n       \"date\": \"05.09.2021 17:40\",\n       \"user\": \"1\",\n       \"created_at\": \"2021-09-05T14:46:06.000000Z\",\n       \"updated_at\": \"2021-09-05T14:46:06.000000Z\"\n   },\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/geolocation/:child/:date"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/geolocation",
    "title": "2. Записать геолокацию ребенка",
    "name": "PostGeolocation",
    "group": "Geolocation",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "latitude",
            "description": "<p>Валидная широта. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "longitude",
            "description": "<p>Валидная долгота. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Адрес. Необязательный. По умолчанию null.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата отправки геолокации в формате d.m.Y H:i. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"latitude\": \"79.837271\",\n    \"longitude\": \"30.312033\",\n    \"address\": \"адрес\",\n    \"date\": \"07.09.2021 17:13\",\n    \"user\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"latitude\": [\n           \"Параметр latitude обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение с созданной геолокацией</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Геолокация добавлена\",\n    \"data\": {\n        \"id\": 5,\n        \"latitude\": \"79.837271\",\n        \"longitude\": \"30.312033\",\n        \"address\": \"адрес\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T15:08:19.000000Z\",\n        \"updated_at\": \"2021-09-07T15:08:19.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/geolocation"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/phones/:phone",
    "title": "5. Удалить телефон",
    "name": "DeletePhone",
    "group": "Phone",
    "version": "1.0.0",
    "description": "<p>phone - Id телефона</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Телефон не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти телефонов с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении телефона</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Телефон удален из списка телефонов\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/phones/:phone"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/phones/:child",
    "title": "1. Получить список телефонов указанного ребенка",
    "name": "GetPhone",
    "group": "Phone",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[Phones]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком телефонов</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 1,\n        \"phone\": \"79999999999\",\n        \"locked\": \"1\",\n        \"user\": \"1\",\n        \"parent\": \"1\",\n        \"created_at\": \"2021-09-05T12:11:30.000000Z\",\n        \"updated_at\": \"2021-09-05T12:11:30.000000Z\"\n    },\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/phones/:child"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/phones/:child/:phone",
    "title": "3. Получить телефон",
    "name": "GetPhoneByDate",
    "group": "Phone",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; phone - Id телефона</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Success",
            "description": "<p>Телефон</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 3,\n    \"phone\": \"79998887766\",\n    \"locked\": \"0\",\n    \"user\": \"1\",\n    \"parent\": \"1\",\n    \"created_at\": \"2021-09-07T15:46:06.000000Z\",\n    \"updated_at\": \"2021-09-07T15:46:06.000000Z\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/phones/:child/:phone"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/phones",
    "title": "2. Записать телефон ребенка",
    "name": "PostPhone",
    "group": "Phone",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Должен быть уникальным для ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "locked",
            "description": "<p>Является ли телефон заблокированным. Необязательный. По умолчанию true.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"phone\": \"79998887766\",\n    \"locked\": false,\n    \"user\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"phone\": [\n           \"Параметр phone обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение с созданным телефоном</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Телефон добавлен\",\n    \"data\": {\n        \"id\": 3,\n        \"phone\": \"79998887766\",\n        \"locked\": \"0\",\n        \"user\": \"1\",\n        \"parent\": \"1\",\n        \"created_at\": \"2021-09-07T15:46:06.000000Z\",\n        \"updated_at\": \"2021-09-07T15:46:06.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/phones"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "patch",
    "url": "/phones/:phone",
    "title": "4. Обновить телефон",
    "name": "UpdatePhone",
    "group": "Phone",
    "version": "1.0.0",
    "description": "<p>phones - Id телефона</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Телефон не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти телефон с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "locked",
            "description": "<p>Является ли телефон заблокированным.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"locked\": true,\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит телефон |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Телефон и сообщение о его обновлении</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Настройки телефона обновлены\",\n    \"data\": {\n        \"id\": 3,\n        \"phone\": \"79998887766\",\n        \"locked\": true,\n        \"user\": \"1\",\n        \"parent\": \"1\",\n        \"created_at\": \"2021-09-07T15:46:06.000000Z\",\n        \"updated_at\": \"2021-09-07T16:12:10.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/phones/:phone"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/sms/:sms",
    "title": "4. Удалить смс",
    "name": "DeleteSms",
    "group": "Sms",
    "version": "1.0.0",
    "description": "<p>sms - Id смс</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Смс не найдено</p>"
          }
        ],
        "Not belong to your child 403": [
          {
            "group": "Not belong to your child 403",
            "optional": false,
            "field": "NotBelongToYourChild",
            "description": "<p>Попытка удалить смс, не принадлежащее ребенку родителя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти смс с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Not belong to your child 403:",
          "content": "{\n  \"message\": \"Это смс не принадлежит вашему ребенку\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит смс |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении смс</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Смс было удалено\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "Sms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/sms/:sms"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/sms/:child/:phone",
    "title": "1. Получить список смс для указанного ребенка и телефона",
    "name": "GetSms",
    "group": "Sms",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[sms]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком смс</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 7,\n        \"phone\": \"79998887766\",\n        \"msg\": \"Текст сообщения\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:26:52.000000Z\",\n        \"updated_at\": \"2021-09-07T16:26:52.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "Sms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/sms/:child/:phone"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/sms/:child/:phone/:date",
    "title": "3. Получить список смс для указанного ребенка по дате",
    "name": "GetSmsByDate",
    "group": "Sms",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.; date - дата записи смс в формате d.m.Y</p>",
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"Параметр date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[sms]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком смс по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/sms/1/79998887766/05.09.2021\n[\n    {\n        \"id\": 7,\n        \"phone\": \"79998887766\",\n        \"msg\": \"Текст сообщения\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:26:52.000000Z\",\n        \"updated_at\": \"2021-09-07T16:26:52.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "Sms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/sms/:child/:phone/:date"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/sms",
    "title": "2. Добавить смс",
    "name": "PostSms",
    "group": "Sms",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "msg",
            "description": "<p>Текст сообщения. Необязательный. По умолчанию null.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "incoming",
            "description": "<p>Является ли смс входящим. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата отправки смс в формате d.m.Y H:i. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"phone\": \"79998887766\",\n    \"msg\": \"Текст сообщения\",\n    \"incoming\": true,\n    \"date\": \"07.09.2021 17:13\",\n    \"user\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Телефон не найден в списке телефонов ребенка</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"phone\": [\n           \"Параметр phone обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Номер телефона 79998887766 не существует в списке номеров указанного ребенка\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Смс с сообщением</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Смс добавлено\",\n    \"data\": {\n        \"id\": 7,\n        \"phone\": \"79998887766\",\n        \"msg\": \"Текст сообщения\",\n        \"locked\": \"1\",\n        \"incoming\": \"1\",\n        \"date\": \"07.09.2021 17:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-07T16:26:52.000000Z\",\n        \"updated_at\": \"2021-09-07T16:26:52.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "Sms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/sms"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/support",
    "title": "Отправка сообщения в поддержку",
    "name": "Support",
    "group": "Support",
    "version": "1.0.0",
    "description": "<p>https://ibb.co/MVwLswT - пример email, приходящего на почту компании</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "theme",
            "description": "<p>Тема сообщения. Обязательный. Должен принимать одно из значений: &quot;Ошибка в приложении&quot;, &quot;Ошибка с оплатой&quot;, &quot;Ошибка в синхронизации&quot;, &quot;Предложения&quot;</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Текст сообщения. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата отправки сообщения в формате d.m.Y H:i. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"theme\": \"Предложения\",\n    \"description\": \"Текст сообщения\",\n    \"date\": \"07.09.2021 17:13\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"theme\": [\n           \"Параметр theme обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об отправке сообщения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Спасибо, за обратную связь, мы ответим вам в ближайшее время\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/support.php",
    "groupTitle": "Support",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/support"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/users",
    "title": "1. Получить авторизированного пользователя",
    "name": "GetUser",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Success",
            "description": "<p>Авторизированный пользователь</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 1,\n    \"fio\": \"Максим Поздняков\",\n    \"email\": \"maximpozdnyakow@gmail.com\",\n    \"terms_agree\": \"1\",\n    \"email_verified\": \"1\",\n    \"created_at\": \"2021-09-05T11:58:04.000000Z\",\n    \"updated_at\": \"2021-09-07T13:30:05.000000Z\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/users"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/users/login",
    "title": "3. Авторизация",
    "name": "LoginUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль пользователя, соответствующий указанному email. Обязательный.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"email\": [\n           \"Веденный вами электронный адрес не связан ни с одним аккаунтом\"\n       ],\n       \"password\": [\n           \"Вы ввели неверный пароль\"\n       ],\n   }\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Пользователь, токен авторизации и сообщение о успешной авторизации</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Вы успешно авторизовались\",\n    \"data\": {\n        \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9\",\n        \"user\": {\n            \"id\": 2\n            \"name\": \"Максим Поздняков Алексеевич\",\n            \"email\": \"maximpozdnyakow@gmail.com\",\n            \"created_at\": \"2021-09-01T15:35:04.000000Z\",\n            \"updated_at\": \"2021-09-01T15:35:04.000000Z\",\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/users/login"
      }
    ]
  },
  {
    "type": "post",
    "url": "/api/users/register",
    "title": "2. Регистрация",
    "name": "RegisterUser",
    "group": "User",
    "version": "1.0.0",
    "description": "<p>После успешной регистрации, на email пользователя отправляется код для подтверждения email.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fio",
            "description": "<p>ФИО пользователя. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Валидный email пользователя. Должен быть уникальным. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "terms_agree",
            "description": "<p>Согласен ли пользователь с условиями соглашения. Должен быть true. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"fio\": \"Максим Поздняков Алексеевич\",\n    \"email\": \"maximpozdnyakow@gmail.com\",\n    \"password\": \"SDGsdfn735F\",\n    \"terms_agree\": true\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"fio\": [\n           \"Укажите ФИО\"\n       ]\n   }\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 201": [
          {
            "group": "Success 201",
            "optional": false,
            "field": "Success",
            "description": "<p>Новый пользователь, токен авторизации и сообщение о успешной регистрации</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 201:",
          "content": "HTTP/1.1 201 Created\n{\n    \"message\": \"Вы успешно зарегистрировались\",\n    \"data\": {\n        \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9\",\n        \"user\": {\n            \"id\": 2\n            \"name\": \"Максим Поздняков Алексеевич\",\n            \"email\": \"maximpozdnyakow@gmail.com\",\n            \"created_at\": \"2021-09-01T15:35:04.000000Z\",\n            \"updated_at\": \"2021-09-01T15:35:04.000000Z\",\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/users/register"
      }
    ]
  },
  {
    "type": "delete",
    "url": "/youtube/:youtube",
    "title": "5. Удалить youtube канал",
    "name": "DeleteYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "description": "<p>youtube - Id youtube канала</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Youtube канал не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти youtube каналов с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении youtube канала</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Youtube канал удален\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube/:youtube"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/youtube/:child",
    "title": "1. Получить список youtube каналов указанного ребенка",
    "name": "GetYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[youtube]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком youtube каналов</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 1,\n        \"channel\": \"maxkatz1\",\n        \"locked\": \"1\",\n        \"start_dt\": \"07.09.2021 17:13\",\n        \"end_dt\": \"07.09.2021 19:13\",\n        \"user\": \"1\",\n        \"parent\": \"1\",\n        \"created_at\": \"2021-09-08T07:46:56.000000Z\",\n        \"updated_at\": \"2021-09-08T07:46:56.000000Z\"\n    },\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube/:child"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/youtube/:child/:youtube",
    "title": "3. Получить youtube канал",
    "name": "GetYoutubeByDate",
    "group": "Youtube",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; youtube - Id youtube канала</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Success",
            "description": "<p>Youtube канал</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/youtube/1/1\n{\n   \"id\": 1,\n   \"channel\": \"maxkatz1\",\n   \"locked\": \"1\",\n   \"start_dt\": \"07.09.2021 17:13\",\n   \"end_dt\": \"07.09.2021 19:13\",\n   \"user\": \"1\",\n   \"parent\": \"1\",\n   \"created_at\": \"2021-09-08T07:46:56.000000Z\",\n   \"updated_at\": \"2021-09-08T07:46:56.000000Z\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube/:child/:youtube"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/youtube_history/:youtube_history",
    "title": "4. Удалить историю посещения ютуба",
    "name": "DeleteYoutubeHistory",
    "group": "YoutubeHistory",
    "version": "1.0.0",
    "description": "<p>youtube_history - Id истории посещения ютуба</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>История посещения ютуба не найдена</p>"
          }
        ],
        "Not belong to your child 403": [
          {
            "group": "Not belong to your child 403",
            "optional": false,
            "field": "NotBelongToYourChild",
            "description": "<p>Попытка удалить историю посещения ютуба, не принадлежащую ребенку родителя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти историю посещения ютуба с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Not belong to your child 403:",
          "content": "{\n  \"message\": \"Эта история посещения ютуба не принадлежит вашему ребенку\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит история посещение ютуба |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение об удалении истории посещения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"История посещения ютуба была удалена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube_history.php",
    "groupTitle": "YoutubeHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube_history/:youtube_history"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/youtube_history/:child/:channel",
    "title": "1. Получить список посещений ютуба для указанного ребенка и канала",
    "name": "GetYoutubeHistory",
    "group": "YoutubeHistory",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; channel - Идентификатор канала или ссылка на него.</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[youtube_history]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком посещений ютуба</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/youtube_history/1/maxkatz1\n[\n    {\n        \"id\": 2,\n        \"channel\": \"maxkatz1\",\n        \"locked\": \"0\",\n        \"user\": \"1\",\n        \"date\": \"06.09.2021 19:13\",\n        \"created_at\": \"2021-09-08T08:11:00.000000Z\",\n        \"updated_at\": \"2021-09-08T08:11:00.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube_history.php",
    "groupTitle": "YoutubeHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube_history/:child/:channel"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/youtube_history/:child/:channel/:date",
    "title": "3. Получить список посещений ютуба для указанного ребенка по дате",
    "name": "GetYoutubeHistoryByDate",
    "group": "YoutubeHistory",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; channel - Идентификатор канала или ссылка на него; date - дата посещения ютуба в формате d.m.Y</p>",
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"Параметр date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[youtube_history]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив со списком посещений ютуба по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/youtube_history/1/maxkatz1/06.09.2021\n[\n    {\n        \"id\": 2,\n        \"channel\": \"maxkatz1\",\n        \"locked\": \"0\",\n        \"user\": \"1\",\n        \"date\": \"06.09.2021 19:13\",\n        \"created_at\": \"2021-09-08T08:11:00.000000Z\",\n        \"updated_at\": \"2021-09-08T08:11:00.000000Z\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube_history.php",
    "groupTitle": "YoutubeHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube_history/:child/:channel/:date"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/youtube_history",
    "title": "2. Добавить историю посещения ютуба",
    "name": "PostYoutubeHistory",
    "group": "YoutubeHistory",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel",
            "description": "<p>Идентификатор канала или ссылка на него. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата посещения канала в формате d.m.Y H:i. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"channel\": \"maxkatz1\",\n    \"user\": \"1\",\n    \"date\": \"06.09.2021 19:13\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Youtube канал не найден в списке youtube каналов ребенка</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"channel\": [\n           \"Параметр channel обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Youtube канала не существует в списке youtube каналов указанного ребенка\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>История посещения ютуба и сообщение о ее создании</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"История посещения youtube канала добавлена\",\n    \"data\": {\n        \"id\": 2,\n        \"channel\": \"maxkatz1\",\n        \"locked\": \"0\",\n        \"user\": \"1\",\n        \"date\": \"06.09.2021 19:13\",\n        \"created_at\": \"2021-09-08T08:11:00.000000Z\",\n        \"updated_at\": \"2021-09-08T08:11:00.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube_history.php",
    "groupTitle": "YoutubeHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube_history"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/youtube",
    "title": "2. Записать youtube канал ребенка",
    "name": "PostYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "channel",
            "description": "<p>Идентификатор канала или ссылка на него. Должен быть уникальным для ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "locked",
            "description": "<p>Является ли youtube канал заблокированным. Необязательный. По умолчанию true.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user",
            "description": "<p>Id ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "start_dt",
            "description": "<p>Время начала доступа к каналу в формате d.m.Y H:i. Необязательный. По умолчанию null.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "end_dt",
            "description": "<p>Время конца доступа к каналу в формате d.m.Y H:i. Необязательный. По умолчанию null.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"channel\": \"maxkatz1\",\n    \"locked\": false,\n    \"user\": \"1\",\n    \"start_dt\": \"07.09.2021 17:13\",\n    \"end_dt\": \"07.09.2021 19:13\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 400": [
          {
            "group": "Bad request 400",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 403": [
          {
            "group": "Not your child 403",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"channel\": [\n           \"Параметр channel обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 403:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение с созданным youtube каналом</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Youtube канал добавлен\",\n    \"data\": {\n        \"id\": 1,\n        \"channel\": \"maxkatz1\",\n        \"locked\": \"1\",\n        \"start_dt\": \"07.09.2021 17:13\",\n        \"end_dt\": \"07.09.2021 19:13\",\n        \"user\": \"1\",\n        \"parent\": \"1\",\n        \"created_at\": \"2021-09-08T07:46:56.000000Z\",\n        \"updated_at\": \"2021-09-08T07:46:56.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, являющийся родителем указанного ребенка |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "patch",
    "url": "/youtube/:youtube",
    "title": "4. Обновить youtube канал",
    "name": "UpdateYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "description": "<p>youtube - Id youtube канала</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Youtube канал не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 401": [
          {
            "group": "Unauthenticated 401",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 403": [
          {
            "group": "No subscription 403",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 403": [
          {
            "group": "Subscription expired 403",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти youtube канал с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 401:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 403:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 403:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "locked",
            "description": "<p>Является ли youtube канал заблокированным.</p>"
          },
          {
            "group": "Parameter",
            "type": "String|null",
            "optional": false,
            "field": "start_dt",
            "description": "<p>Время начала доступа к каналу в формате d.m.Y H:i.</p>"
          },
          {
            "group": "Parameter",
            "type": "String|null",
            "optional": false,
            "field": "end_dt",
            "description": "<p>Время конца доступа к каналу в формате d.m.Y H:i.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"locked\": false,\n    \"start_dt\": null,\n    \"end_dt\": \"07.09.2021 19:13\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит youtube канал |"
      },
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Youtube канал и сообщение о его обновлении</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Настройки youtube канала обновлены\",\n    \"data\": {\n         \"id\": 1,\n         \"channel\": \"maxkatz1\",\n         \"locked\": 0,\n         \"start_dt\": null,\n         \"end_dt\": \"07.09.2021 19:13\",\n         \"user\": \"1\",\n         \"parent\": \"1\",\n         \"created_at\": \"2021-09-08T07:46:56.000000Z\",\n         \"updated_at\": \"2021-09-08T07:46:56.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube/:youtube"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Bearer $token</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  }
] });
