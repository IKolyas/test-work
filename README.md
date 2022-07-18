# API

## api routes
```
GET http://a0697020.xsph.ru/api/ads
```
```
return json structure:
{
    "status",
    "ads": [
        {
            "id",
            "title",
            "image",
            "price"
        },
        ...
    ],
    "last_page": 3,
    "current_page": 1
}
```

```
GET http://a0697020.xsph.ru/api/ads/{adId}?fields[]=created_at&fields[]=description&fields[]=adImages
```
```
params: 
    optionaly:
    fields = ['created_at', 'description', 'adImages']
```
```
return json structure:
{
    "status",
    "ad": {
            "id",
            "title",
            "image",
            "price",
            "created_at",
            "description",
            "adImages": [
                {
                     "id",
                     "url",
                     "priority"
                },
                ...
            ]
        }
}
```

```
POST http://a0697020.xsph.ru/api/ads
```
```
params:
{
    "title",
    "description",
    "price",
    "contacts",
    "images": [
        {
            "url",
            "priority"
        },
        ...
    ]
}
```
```
return json structure:
{
    "status",
    "ad"
}

```
