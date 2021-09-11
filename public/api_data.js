define({ "api": [
  {
    "type": "delete",
    "url": "/api/applications/:application",
    "title": "5. Удалить приложение",
    "name": "DeleteApplication",
    "group": "Application",
    "version": "1.0.0",
    "description": "<p>application - Id приложения</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Приложение не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти приложений с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит приложение |"
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
            "description": "<p>Сообщение об удалении приложения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Приложение удален\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/applications.php",
    "groupTitle": "Application",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/applications/:application"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/applications/:child",
    "title": "1. Получить список приложений указанного ребенка",
    "name": "GetApplication",
    "group": "Application",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[applications]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив приложений</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/applications/1\n[\n    {\n        \"id\": 1,\n        \"package\": \"whatsapp\",\n        \"name\": \"Whatsapp\",\n        \"image\": \"data:image/png;base64,iVBORw0KG ...\",\n        \"locked\": \"0\",\n        \"start_dt\": null,\n        \"end_dt\": null,\n        \"parent\": \"1\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-08T13:14:56.000000Z\",\n        \"updated_at\": \"2021-09-08T13:14:56.000000Z\"\n    },\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/applications.php",
    "groupTitle": "Application",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/applications/:child"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/applications/:child/:application",
    "title": "3. Получить приложение",
    "name": "GetApplicationById",
    "group": "Application",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; application - Id приложения</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Success",
            "description": "<p>Приложение</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/applications/1/1\n{\n    \"id\": 1,\n    \"package\": \"whatsapp\",\n    \"name\": \"Whatsapp\",\n    \"image\": \"data:image/png;base64,iVBORw0KG ...\",\n    \"locked\": \"0\",\n    \"start_dt\": null,\n    \"end_dt\": null,\n    \"parent\": \"1\",\n    \"user\": \"1\",\n    \"created_at\": \"2021-09-08T13:14:56.000000Z\",\n    \"updated_at\": \"2021-09-08T13:14:56.000000Z\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/applications.php",
    "groupTitle": "Application",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/applications/:child/:application"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/api/youtube_history/:youtube_history",
    "title": "5. Удалить историю использования приложения",
    "name": "DeleteApplicationHistory",
    "group": "ApplicationHistory",
    "version": "1.0.0",
    "description": "<p>youtube_history - Id истории использования приложения</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>История использования приложения не найдена</p>"
          }
        ],
        "Not belong to your child 403": [
          {
            "group": "Not belong to your child 403",
            "optional": false,
            "field": "NotBelongToYourChild",
            "description": "<p>Попытка удалить историю использования приложения, не принадлежащую ребенку родителя</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти историю использования приложения с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Not belong to your child 403:",
          "content": "{\n  \"message\": \"Эта история использования приложения не принадлежит вашему ребенку\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит история использования приложения |"
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
            "description": "<p>Сообщение об удалении истории использования приложения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"История использования приложения была удалена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/application_history.php",
    "groupTitle": "ApplicationHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube_history/:youtube_history"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/application_history/:child/:package",
    "title": "1. Получить историю использования приложения для указанного ребенка",
    "name": "GetApplicationHistory",
    "group": "ApplicationHistory",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; package - Идентификатор приложения.</p>",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[youtube_history]",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив с историей использования приложения и изображение приложения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/youtube_history/1/whatsapp\n{\n    \"data\": {\n        \"history\": [\n            {\n                \"id\": 1,\n                \"package\": \"whatsapp\",\n                \"name\": \"Whatsapp\",\n                \"locked\": \"0\",\n                \"start_dt\": \"07.09.2021 19:13\",\n                \"end_dt\": \"07.09.2021 20:13\",\n                \"user\": \"1\",\n                \"created_at\": \"2021-09-08T13:57:22.000000Z\",\n                \"updated_at\": \"2021-09-08T13:57:22.000000Z\"\n            }\n        ],\n        \"image\": \"data:image/png;base64,iVBORw0KG...\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/application_history.php",
    "groupTitle": "ApplicationHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/application_history/:child/:package"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/youtube_history/:child/:package/:date",
    "title": "3. Получить историю использования приложения для указанного ребенка по дате",
    "name": "GetApplicationHistoryByDate",
    "group": "ApplicationHistory",
    "version": "1.0.0",
    "description": "<p>child - Id ребенка; package - Идентификатор приложения; date - дата использования приложения в формате d.m.Y</p>",
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
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
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
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Массив с историей использования приложения в указанный день и изображение приложения</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "/api/youtube_history/1/whatsapp/07.09.2021\n{\n    \"data\": {\n        \"history\": [\n            {\n                \"id\": 1,\n                \"package\": \"whatsapp\",\n                \"name\": \"Whatsapp\",\n                \"locked\": \"0\",\n                \"start_dt\": \"07.09.2021 19:13\",\n                \"end_dt\": \"07.09.2021 20:13\",\n                \"user\": \"1\",\n                \"created_at\": \"2021-09-08T13:57:22.000000Z\",\n                \"updated_at\": \"2021-09-08T13:57:22.000000Z\"\n            }\n        ],\n        \"image\": \"data:image/png;base64,iVBORw0KG...\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/application_history.php",
    "groupTitle": "ApplicationHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube_history/:child/:package/:date"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/youtube_history",
    "title": "2. Добавить историю использования приложения",
    "name": "PostApplicationHistory",
    "group": "ApplicationHistory",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "package",
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
            "field": "start_dt",
            "description": "<p>Дата начала использования приложения в формате d.m.Y H:i. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n   \"package\": \"whatsapp\",\n   \"user\": \"1\",\n   \"start_dt\": \"07.09.2021 19:13\"\n}",
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
            "description": "<p>Приложение не найдено в списке приложений ребенка</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"package\": [\n           \"Параметр package обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Приложение не существует в списке приложений указанного ребенка\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>История использования приложения и сообщение о ее создании</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"История использования приложения добавлена\",\n    \"data\": {\n        \"id\": 1,\n        \"package\": \"whatsapp\",\n        \"name\": \"Whatsapp\",\n        \"image\": \"data:image/png;base64,iVBORw0...\",\n        \"locked\": \"0\",\n        \"start_dt\": \"07.09.2021 19:13\",\n        \"end_dt\": null,\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-08T13:57:22.000000Z\",\n        \"updated_at\": \"2021-09-08T13:57:22.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/application_history.php",
    "groupTitle": "ApplicationHistory",
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "patch",
    "url": "/api/youtube_history/:youtube_history",
    "title": "4. Обновить историю использования приложения",
    "name": "UpdateApplicationHistory",
    "group": "ApplicationHistory",
    "version": "1.0.0",
    "description": "<p>youtube_history - Id истории использования приложения</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "end_dt",
            "description": "<p>Дата окончания использования приложения в формате d.m.Y H:i.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n   \"end_dt\": \"07.09.2021 20:13\"\n}",
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
            "description": "<p>Приложение не найдено в списке приложений ребенка</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"end_dt\": [\n           \"Параметр end_dt должен быть датой формата d.m.Y H:i\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Приложение не существует в списке приложений указанного ребенка\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>История использования приложения и сообщение о ее обновлении</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"История использования приложения обновлена\",\n    \"data\": {\n        \"id\": 1,\n        \"package\": \"whatsapp\",\n        \"name\": \"Whatsapp\",\n        \"image\": \"data:image/png;base64,iVBORw0...\",\n        \"locked\": \"0\",\n        \"start_dt\": \"07.09.2021 19:13\",\n        \"end_dt\": \"07.09.2021 20:13\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-08T13:57:22.000000Z\",\n        \"updated_at\": \"2021-09-08T13:57:22.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/application_history.php",
    "groupTitle": "ApplicationHistory",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube_history/:youtube_history"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/applications",
    "title": "2. Добавить приложение",
    "name": "PostApplication",
    "group": "Application",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "package",
            "description": "<p>Идентификатор приложения. Должен быть уникальным для ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "image",
            "description": "<p>Изображение приложения в формате png, jpg или svg. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Наименование приложения. Обязательный.</p>"
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
          "content": "{\n   \"package\": \"whatsapp\",\n   \"name\": WhatsApp,\n   \"user\": \"1\",\n   \"image\": Иконка WhatsApp\n}",
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
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 400:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"package\": [\n           \"Параметр package обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Приложение и сообщение о его добавлении</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Мобильное приложение добавлено\",\n    \"data\": {\n        \"id\": 1,\n        \"package\": \"whatsapp\",\n        \"name\": \"Whatsapp\",\n        \"image\": \"data:image/png;base64,iVBORw0KG ...\",\n        \"locked\": \"0\",\n        \"start_dt\": null,\n        \"end_dt\": null,\n        \"parent\": \"1\",\n        \"user\": \"1\",\n        \"created_at\": \"2021-09-08T13:14:56.000000Z\",\n        \"updated_at\": \"2021-09-08T13:14:56.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/applications.php",
    "groupTitle": "Application",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/applications"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/applications/:application",
    "title": "4. Обновить настройки приложения",
    "name": "UpdateApplication",
    "group": "Application",
    "version": "1.0.0",
    "description": "<p>application - Id приложения</p>",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Приложение не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти приложение с указанным id\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "type": "File",
            "optional": false,
            "field": "image",
            "description": "<p>Изображение приложения в формате png, jpg или svg.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Наименование приложения.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "locked",
            "description": "<p>Является ли приложение заблокированным.</p>"
          },
          {
            "group": "Parameter",
            "type": "String|null",
            "optional": false,
            "field": "start_dt",
            "description": "<p>Время начала доступа к приложениеу в формате d.m.Y H:i.</p>"
          },
          {
            "group": "Parameter",
            "type": "String|null",
            "optional": false,
            "field": "end_dt",
            "description": "<p>Время конца доступа к приложениеу в формате d.m.Y H:i.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"locked\": true,\n    \"start_dt\": null,\n    \"end_dt\": \"07.09.2021 19:13\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "Пользователь, ребенку которого принадлежит приложение |"
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
            "description": "<p>Приложение и сообщение о его обновлении</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Настройки приложения обновлены\",\n    \"data\": {\n         \"id\": 1,\n         \"package\": \"whatsapp\",\n         \"name\": \"Whatsapp\",\n         \"image\": \"data:image/png;base64,iVBORw0KG...\",\n         \"locked\": \"1\",\n         \"start_dt\": null,\n         \"end_dt\": \"07.09.2021 19:13\",\n         \"parent\": \"1\",\n         \"user\": \"1\",\n         \"created_at\": \"2021-09-08T13:14:56.000000Z\",\n         \"updated_at\": \"2021-09-08T13:14:56.000000Z\"\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/applications.php",
    "groupTitle": "Application",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/applications/:application"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/numberphones/story",
    "title": "1. Получить список звонков и смс для указанного ребенка по дате",
    "name": "GetCallsAndSmsByDate",
    "group": "CallsAndSms",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата добавления звонков и смс в формате d.m.Y</p>"
          },
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
          "content": "{\n   \"child\": \"1\",\n   \"date\": \"07.09.2021\"\n}",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Массив звонков и смс по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"phone\": \"+79998887744\",\n        \"input\": \"1\",\n        \"isCall\": \"1\",\n        \"message\": null,\n        \"date\": \"07.09.2021 13:33:21\"\n    },\n    {\n        \"phone\": \"+79998887734\",\n        \"input\": \"1\",\n        \"isCall\": \"0\",\n        \"message\": \"Новое сообщение\",\n        \"date\": \"07.09.2021 16:33:22\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "CallsAndSms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/numberphones/story"
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
    ]
  },
  {
    "type": "post",
    "url": "/api/numberphones/story",
    "title": "2. Добавить звонки и смс ребенка",
    "name": "PostCallsAndSms",
    "group": "CallsAndSms",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Валидный номер телефона, начинающийся с + и кода страны. Состоит из ровно 11 цифр. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "input",
            "description": "<p>Является ли смс или звонок входящим. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "isCall",
            "description": "<p>Является звонком или смс. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Текст смс. Необязательный. По умолчанию null.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата отправки смс или звонка в формате d.m.Y H:i:s. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"child\": \"1\",\n    \"phones\":\n        [\n            {\n                \"date\": \"07.09.2021 13:33:21\",\n                \"phone\": \"+79998887744\",\n                \"input\": true,\n                \"isCall\": true,\n                \"msg\": \"\"\n            },\n            {\n                \"date\": \"07.09.2021 16:33:22\",\n                \"phone\": \"+79998887734\",\n                \"input\": true,\n                \"isCall\": false,\n                \"msg\": \"Новое сообщение\"\n            }\n        ]\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"phones.0.phone\": [\n           \"Параметр phones.0.phone обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Сообщение о добавлении звонков и смс</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Звонки и смс добавлены\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sms.php",
    "groupTitle": "CallsAndSms",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/numberphones/story"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/api/child/object",
    "title": "5. Удалить ребенка",
    "name": "DeleteChild",
    "group": "Child",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
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
          "content": "{ \"child\": \"1\" }",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
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
            "description": "<p>Сообщение об удалении ребенка</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Ребенок удален\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/children.php",
    "groupTitle": "Child",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/child/object"
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
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/child/list",
    "title": "1. Получить список детей",
    "name": "GetChild",
    "group": "Child",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[children]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список детей авторизированного пользователя. Их число ограничено текущей подпиской. К примеру, у пользователя была подключена подписка с 5 устройствами, и он зарегистрировал 5 детей. Но потом она истекла, и он подключил подписку дешевле, на 3 устройства. Тогда этот метод вернет первых трех детей из пяти.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 1,\n        \"name\": \"Вова\",\n        \"year\": \"2014\",\n        \"parent\": \"2\"\n    },\n    {\n        \"id\": 2,\n        \"name\": \"Юля\",\n        \"year\": \"2014\",\n        \"parent\": \"2\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/children.php",
    "groupTitle": "Child",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/child/list"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/child/object",
    "title": "3. Получить ребенка",
    "name": "GetOneChild",
    "group": "Child",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
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
          "content": "{ \"child\": \"1\" }",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "Success",
            "description": "<p>Ребенок</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 1,\n    \"name\": \"Вова\",\n    \"year\": \"2014\",\n    \"parent\": \"2\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/children.php",
    "groupTitle": "Child",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/child/object"
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
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/child/object",
    "title": "2. Добавить ребенка",
    "name": "PostChild",
    "group": "Child",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Имя ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "year",
            "description": "<p>Год рождения ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"child\": {\n        \"name\": \"Вова\",\n        \"year\": 2014\n    }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Devices Limit Reached 404": [
          {
            "group": "Devices Limit Reached 404",
            "optional": false,
            "field": "DevicesLimitReached",
            "description": "<p>Возникает при попытке добавить больше устройств, чем позволяет подписка</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"child.name\": [\n           \"Параметр child.name обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Devices Limit Reached 404:",
          "content": "{\n   \"message\": \"Вам можно подключить не более 3 устройств\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Новый ребенок</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 2,\n    \"name\": \"Юля\",\n    \"year\": \"2014\",\n    \"parent\": \"2\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/children.php",
    "groupTitle": "Child",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/child/object"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "put",
    "url": "/api/child/object",
    "title": "4. Обновить данные ребенка",
    "name": "UpdateChild",
    "group": "Child",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Id ребенка.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Имя ребенка.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "year",
            "description": "<p>Год рождения ребенка</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"child\": {\n        \"id\": \"1\",\n        \"name\": \"Вадим\",\n        \"year\": 2015\n    }\n}",
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
            "description": "<p>Обновленный ребенок</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 1,\n    \"name\": \"Вадим\",\n    \"year\": 2015,\n    \"parent\": \"2\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/children.php",
    "groupTitle": "Child",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/child/object"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/gps/story",
    "title": "1. Получить список местоположений для указанного ребенка по дате",
    "name": "GetGeolocationByDate",
    "group": "Geolocation",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата добавления геолокации в формате d.m.Y</p>"
          },
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
          "content": "{\n   \"child\": \"1\",\n   \"date\": \"07.09.2021\"\n}",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некорректная дата</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"date должен быть датой формата d.m.Y\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Массив местоположений по указанной дате</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"latitude\": \"79.837271\",\n        \"longitude\": \"30.312033\",\n        \"address\": \"адрес\",\n        \"date\": \"07.09.2021 17:13\"\n    },\n    {\n        \"latitude\": \"69.837271\",\n        \"longitude\": \"30.312033\",\n        \"address\": \"адрес2\",\n        \"date\": \"07.09.2021 18:13\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/gps/story"
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
    ]
  },
  {
    "type": "post",
    "url": "/api/gps/story",
    "title": "2. Добавить местоположение ребенка",
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
            "field": "child",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "[\n    {\n        \"date\": \"08.09.2021 13:33\",\n        \"latitude\": \"52.2234234\",\n        \"longitude\": \"33.1244433\",\n        \"child\": \"1\"\n    },\n    {\n        \"date\": \"08.09.2021 14:21\",\n        \"latitude\": \"52.5534234\",\n        \"longitude\": \"33.3344433\",\n        \"child\": \"1\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"0.latitude\": [\n           \"Параметр 0.latitude обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Сообщение о добавлении геолокации</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Геолокация добавлена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/geolocation.php",
    "groupTitle": "Geolocation",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/gps/story"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/api/numberphones/blocked",
    "title": "3. Разблокировать телефон",
    "name": "DeletePhone",
    "group": "Phone",
    "version": "1.0.0",
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
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти телефон\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>Заблокированный телефон</p>"
          },
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
          "content": "{\n   \"child\": \"1\",\n   \"phone\": \"+79996665544\"\n}",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
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
            "description": "<p>Сообщение об разблокировки телефона</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Телефон разблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/numberphones/blocked"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ]
  },
  {
    "type": "get",
    "url": "/numberphones/blocked",
    "title": "1. Получить список заблокированных телефонов указанного ребенка",
    "name": "GetPhone",
    "group": "Phone",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
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
          "content": "{ \"child\": \"1\" }",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[sites]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список заблокированных телефонов</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    \"+79998887766\",\n    \"+79997776655\",\n    \"+79996665544\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/numberphones/blocked"
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
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/numberphones/blocked",
    "title": "2. Заблокировать телефон",
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
            "description": "<p>Валидный номер телефона, начинающийся с плюса и кода страны. Состоит из ровно 11 цифр. Должен быть уникальным для ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"phone\": \"+79996665544\",\n    \"child\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"phone\": [\n           \"Параметр phone обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Сообщение о блокировании телефона</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Телефон заблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/phone.php",
    "groupTitle": "Phone",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/numberphones/blocked"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "delete",
    "url": "/api/websites/blocked",
    "title": "3. Разблокировать сайт",
    "name": "DeleteSite",
    "group": "Site",
    "version": "1.0.0",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>Сайт не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти сайт\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "site",
            "description": "<p>Заблокированный сайт</p>"
          },
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
          "content": "{\n   \"child\": \"1\",\n   \"site\": \"google.com\"\n}",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
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
            "description": "<p>Сообщение об разблокировки сайта</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Сайт разблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sites.php",
    "groupTitle": "Site",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/websites/blocked"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ]
  },
  {
    "type": "get",
    "url": "/websites/blocked",
    "title": "1. Получить список заблокированных сайтов указанного ребенка",
    "name": "GetSite",
    "group": "Site",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
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
          "content": "{ \"child\": \"1\" }",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[sites]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список заблокированных сайтов</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    \"google.com\",\n    \"youtube.com\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sites.php",
    "groupTitle": "Site",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/websites/blocked"
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
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/websites/blocked",
    "title": "2. Заблокировать сайт",
    "name": "PostSite",
    "group": "Site",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "site",
            "description": "<p>Валидный хост или IP-адрес. Должен быть уникальным для ребенка. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"site\": \"youtube.com\",\n    \"child\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"site\": [\n           \"Параметр site обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Сообщение о блокировании сайта</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Сайт заблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/sites.php",
    "groupTitle": "Site",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/websites/blocked"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/subscribes/list",
    "title": "1. Получить список подписок",
    "name": "GetSubscription",
    "group": "Subscription",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[subscriptions]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список всех подписок</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 1,\n        \"name\": \"Small\",\n        \"device\": \"3\",\n        \"price\": \"199.0\",\n        \"freeMonth\": \"1\"\n    },\n    {\n        \"id\": 2,\n        \"name\": \"Medium\",\n        \"device\": \"5\",\n        \"price\": \"249.0\",\n        \"freeMonth\": \"1\"\n    },\n    {\n        \"id\": 3,\n        \"name\": \"Large\",\n        \"device\": \"10\",\n        \"price\": \"299.0\",\n        \"freeMonth\": \"1\"\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/subscriptions.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/subscribes/list"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/user/subscribe",
    "title": "3. Получить подписки, одна из них будет или нет, с признаком активности",
    "name": "GetSubscription",
    "group": "Subscription",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[subscriptions]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список всех подписок авторизированного, истекших и активных.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    {\n        \"id\": 1,\n        \"name\": \"Small\",\n        \"device\": \"3\",\n        \"price\": \"199.0\",\n        \"freeMonth\": \"1\",\n        \"active\": false\n    },\n    {\n        \"id\": 2,\n        \"name\": \"Medium\",\n        \"device\": \"5\",\n        \"price\": \"249.0\",\n        \"freeMonth\": \"1\",\n        \"active\": true\n    },\n    {\n        \"id\": 3,\n        \"name\": \"Large\",\n        \"device\": \"10\",\n        \"price\": \"299.0\",\n        \"freeMonth\": \"1\",\n        \"active\": false\n    }\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/subscriptions.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/subscribe"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/subscribes/object",
    "title": "2. Добавить подписку",
    "name": "PostSubscription",
    "group": "Subscription",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Наименование подписки. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "payed_num_of_months",
            "description": "<p>Количество оплаченных месяцев. В него не входят бесплатные месяцы. Если нужно активировать только бесплатный месяц, передавайте 0.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"name\": \"Medium\",\n    \"payed_num_of_months\": 3\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
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
            "description": "<p>Возникает, при указании имени не существующей подписки</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"name\": [\n           \"Параметр name обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не существует подписки с названием Extra Big\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
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
            "description": "<p>Сообщение о создании подписки</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Подписка добавлена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/subscriptions.php",
    "groupTitle": "Subscription",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/subscribes/object"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/api/support/themes",
    "title": "1. Получить все темы",
    "name": "GetSupportThemes",
    "group": "Support",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Массив тем</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    \"Ошибка в приложении\",\n    \"Ошибка с оплатой\",\n    \"Ошибка в синхронизации\",\n    \"Предложения\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/support.php",
    "groupTitle": "Support",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/support/themes"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/support/object",
    "title": "2. Отправка сообщения в поддержку",
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
            "field": "message",
            "description": "<p>Текст сообщения. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date",
            "description": "<p>Дата отправки сообщения в формате d.m.Y H:i. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fio",
            "description": "<p>ФИО пользователя, отправившего сообщение. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Валидный email пользователя, отправившего сообщение. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"fio\": \"Поздняков Максим Алексеевич\",\n    \"email\": \"maximpozdnyakow@gmail.com\",\n    \"theme\": \"Ошибка с оплатой\",\n    \"message\": \"Обращение в службу поддержки\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"theme\": [\n           \"Параметр theme обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
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
        "url": "http://localhost:3000/api/support/object"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/user/restore",
    "title": "5. Запрос на отправку кода для сброса пароля",
    "name": "ForgotUserPassword",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>Тело запроса, строка, валидный email существующего пользователя. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "\"maximpozdnyakow@gmail.com\"",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n    \"message\": \"The given data was invalid.\",\n    \"errors\": [\n        [\n            \"Укажите корректный email\"\n        ]\n    ]\n}",
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
            "description": "<p>Сообщение об отправке шестизначного кода для сброса пароля</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Код для сброса пароля отправлен на вашу электронную почту\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/restore"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/user/auth",
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
          "content": "{\n    \"id\": 2,\n    \"fio\": \"Максим Поздняков\",\n    \"email\": \"maximpozdnyakow@gmail.com\",\n    \"termsAgree\": \"1\",\n    \"emailVerified\": \"0\",\n    \"emailNotify\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/auth"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/user/login",
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
            "field": "pass",
            "description": "<p>Пароль пользователя, соответствующий указанному email. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"email\": \"maximpozdnyakow@gmail.com\",\n    \"pass\": \"SDGsdfn735F\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"email\": [\n           \"Веденный вами электронный адрес не связан ни с одним аккаунтом\"\n       ],\n       \"pass\": [\n           \"Вы ввели неверный пароль\"\n       ],\n   }\n}",
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
            "description": "<p>Пользователь</p>"
          }
        ],
        "Header Success 200": [
          {
            "group": "Header Success 200",
            "optional": false,
            "field": "HeaderSuccess",
            "description": "<p>Токен авторизации передается через header</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n   \"id\": 2,\n   \"fio\": \"Максим Поздняков\",\n   \"email\": \"maximpozdnyakow@gmail.com\",\n   \"termsAgree\": \"1\",\n   \"emailVerified\": \"0\",\n   \"emailNotify\": \"1\"\n}",
          "type": "json"
        },
        {
          "title": "Header Success 200:",
          "content": "{\n   \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/login"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/user/logout",
    "title": "4. Выйти из аккаунта",
    "name": "LogoutUser",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение о выходе</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Вы вышли из аккаунта\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/logout"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/user/register",
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
            "field": "pass",
            "description": "<p>Пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "termsAgree",
            "description": "<p>Согласен ли пользователь с условиями соглашения. Должен быть true. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n   \"email\": \"maximpozdnyakow@gmail.com\",\n   \"fio\": \"Максим Поздняков\",\n   \"termsAgree\": true,\n   \"pass\": \"SDGsdfn735F\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"fio\": [\n           \"Укажите ФИО\"\n       ]\n   }\"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...\"\n}",
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
            "description": "<p>Новый пользователь</p>"
          }
        ],
        "Header Success 200": [
          {
            "group": "Header Success 200",
            "optional": false,
            "field": "HeaderSuccess",
            "description": "<p>Токен авторизации передается через header</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n   \"id\": 2,\n   \"fio\": \"Максим Поздняков\",\n   \"email\": \"maximpozdnyakow@gmail.com\",\n   \"termsAgree\": \"1\",\n   \"emailVerified\": \"0\",\n   \"emailNotify\": \"1\"\n}",
          "type": "json"
        },
        {
          "title": "Header Success 200:",
          "content": "{\n   \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/register"
      }
    ]
  },
  {
    "type": "post",
    "url": "/api/user/reset",
    "title": "6. Сброс пароля",
    "name": "RestUserPassword",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Шестизначный код для сброса пароля. Обязательный.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pass",
            "description": "<p>Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"token\": \"396402\",\n    \"pass\": \"SDGsdfn735F\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"token\": [\n           \"Веденный вами код для сброса пароля недействителен\"\n       ]\n   }\n}",
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
            "description": "<p>Сообщение о успешном изменении пароля</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Ваш пароль был успешно изменен\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/reset"
      }
    ]
  },
  {
    "type": "get",
    "url": "/api/user/check",
    "title": "8. Запросить новый код подтверждения email",
    "name": "SendVerifyCodeForUserEmail",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "Success",
            "description": "<p>Сообщение о успешном подтверждении email</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Код для подтверждения email отправлен на вашу электронную почту\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/check"
      }
    ]
  },
  {
    "type": "patch",
    "url": "/api/user/object",
    "title": "7. Обновление данных пользователя",
    "name": "UpdateUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fio",
            "description": "<p>Новое ФИО пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Новый валидный email пользователя. Должен быть уникальным. После обновления email, на него присылается код для подтверждения email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pass",
            "description": "<p>Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"fio\": \"Максим Поздняков Алексеевич\",\n    \"email\": \"maxim@gmail.com\",\n    \"pass\": \"SDGsdfn735F\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"email\": [\n           \"Пользователь с такими email уже существует\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
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
            "description": "<p>Обновленный пользователь</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"id\": 2,\n    \"fio\": \"Максим Поздняков Алексеевич\",\n    \"email\": \"maxim@gmail.com\",\n    \"termsAgree\": \"1\",\n    \"emailVerified\": 0,\n    \"emailNotify\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/object"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/user/check",
    "title": "9. Подтверждение email",
    "name": "VerifyUserEmail",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Тело запроса, шестизначный код для подтверждения email.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "\"396402\"",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"Веденный вами код для подтверждения email недействителен\"\n}",
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
            "description": "<p>Сообщение о успешном подтверждении email</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Ваша электронная почта была подтверждена\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/users.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/user/check"
      }
    ]
  },
  {
    "type": "delete",
    "url": "/api/youtube/blocked",
    "title": "3. Разблокировать youtube канал",
    "name": "DeleteYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "error": {
      "fields": {
        "Not Found 404": [
          {
            "group": "Not Found 404",
            "optional": false,
            "field": "NotFound",
            "description": "<p>youtube канал не найден или не принадлежит ребенку пользователя</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Not Found 404:",
          "content": "{\n   \"message\": \"Не удалось найти youtube канал\",\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Youtube",
            "description": "<p>Заблокированный youtube канал</p>"
          },
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
          "content": "{\n   \"child\": \"1\",\n   \"channel\": \"NakeyJakey\"\n}",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
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
            "description": "<p>Сообщение об разблокировки youtube канала</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Youtube канал разблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube/blocked"
      }
    ],
    "permission": [
      {
        "name": "Авторизованный пользователь |"
      },
      {
        "name": "Пользователь, обладающий активной подпиской"
      }
    ]
  },
  {
    "type": "get",
    "url": "/youtube/blocked",
    "title": "1. Получить список заблокированных youtube каналов указанного ребенка",
    "name": "GetYoutube",
    "group": "Youtube",
    "version": "1.0.0",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка</p>"
          },
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
          "content": "{ \"child\": \"1\" }",
          "type": "json"
        },
        {
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array[Youtubes]",
            "optional": false,
            "field": "Success",
            "description": "<p>Список заблокированных youtube каналов</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "[\n    \"NakeyJakey\",\n    \"BeatEmUps\"\n]",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/youtube/blocked"
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
    "error": {
      "fields": {
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
          "content": "{\n  \"message\": \"Действие вашей подписки истекло, оформите новую\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/api/youtube/blocked",
    "title": "2. Заблокировать youtube канал",
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
            "description": "<p>Идентификатор канала или ссылка на него. Должен быть уникальным для ребенка. Обязательный. Нельзя добавить идентификатор канала и ссылку, относящиеся к одному каналу. К примеру, если в базе уже создана сущность с channel=https://www.youtube.com/c/maxkatz1 , то при добавлении сущности с channel=maxkatz1 , метод выдаст ошибку.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "child",
            "description": "<p>Id ребенка. Обязательный.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request:",
          "content": "{\n    \"channel\": \"NakeyJakey\",\n    \"child\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Bad request 404": [
          {
            "group": "Bad request 404",
            "optional": false,
            "field": "BadRequest",
            "description": "<p>Некоторые параметры не прошли валидацию</p>"
          }
        ],
        "Unauthenticated 404": [
          {
            "group": "Unauthenticated 404",
            "optional": false,
            "field": "Unauthenticated",
            "description": "<p>Не был предоставлен токен авторизации, или же он недействителен</p>"
          }
        ],
        "Not your child 404": [
          {
            "group": "Not your child 404",
            "optional": false,
            "field": "NotYourChild",
            "description": "<p>Указанный ребенок не существует или не принадлежит текущему пользователю</p>"
          }
        ],
        "No subscription 404": [
          {
            "group": "No subscription 404",
            "optional": false,
            "field": "NoSubscription",
            "description": "<p>Пользователь не оформил подписку</p>"
          }
        ],
        "Subscription expired 404": [
          {
            "group": "Subscription expired 404",
            "optional": false,
            "field": "SubscriptionExpired",
            "description": "<p>Подписка пользователя истекла</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Bad request 404:",
          "content": "{\n   \"message\": \"The given data was invalid.\",\n   \"errors\": {\n       \"channel\": [\n           \"Параметр channel обязателен\"\n       ]\n   }\n}",
          "type": "json"
        },
        {
          "title": "Unauthenticated 404:",
          "content": "{\n  \"message\": \"Unauthenticated.\"\n}",
          "type": "json"
        },
        {
          "title": "Not your child 404:",
          "content": "{\n  \"message\": \"Указанный ребенок вам не принадлежит\"\n}",
          "type": "json"
        },
        {
          "title": "No subscription 404:",
          "content": "{\n  \"message\": \"Оформите подписку\"\n}",
          "type": "json"
        },
        {
          "title": "Subscription expired 404:",
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
            "description": "<p>Сообщение о блокировании youtube канала</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success 200:",
          "content": "{\n    \"message\": \"Youtube канал заблокирован\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "docSrc/youtube.php",
    "groupTitle": "Youtube",
    "sampleRequest": [
      {
        "url": "http://localhost:3000/api/youtube/blocked"
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
          "title": "Authorization Header:",
          "content": "{ \"Authorization\": \"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO\" }",
          "type": "json"
        }
      ]
    }
  }
] });
