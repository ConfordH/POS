# Add New Product

> Use this endpoint resource if you want to add new product. The name must be unique.

----


## Parameters Accepted

` name `

` price`

` category_id `

`description`

---
## Headers Accepted

1. `Accept ` -> `application/json`
2. `Authorization` -> `Bearer <token>`

## Test It

<larecipe-swagger endpoint="/api/products" default-method='post'></larecipe-swagger>