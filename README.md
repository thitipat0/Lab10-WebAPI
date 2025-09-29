นายฐิติภัทร์ ชุ่มมา 67543210053-4
# Lab10-WebAPI
## Lab10 – Fruit Store Web API 🍎🍌🍊

## คำอธิบายโปรเจกต์
โปรเจกต์นี้เป็น **Web API** สำหรับจัดการข้อมูลสินค้าในร้านผลไม้  
ใช้ **PHP** และ **MySQL** ผ่าน XAMPP  
API สามารถทำงานแบบ **CRUD** (Create, Read, Update, Delete) เหมือน [FakeStoreAPI](https://fakestoreapi.com/docs#tag/Products)

**ฟีเจอร์ของ API:**
- ดูข้อมูลสินค้าทั้งหมด (`GET /products/getAll.php`)
- ดูข้อมูลสินค้าตาม ID (`GET /products/getOne.php?id=ID`)
- เพิ่มสินค้าใหม่ (`POST /products/create.php`)
- แก้ไขสินค้า (`PUT /products/update.php?id=ID`)
- ลบสินค้า (`DELETE /products/delete.php?id=ID`)

ข้อมูลสินค้าอยู่ในรูปแบบ **JSON**

---

## โครงสร้างไฟล์
```
fruit-api/
├─ db.php # เชื่อมต่อฐานข้อมูล MySQL
└─ products/
├─ getAll.php # ดึงข้อมูลสินค้าทั้งหมด
├─ getOne.php # ดึงข้อมูลสินค้าตาม ID
├─ create.php # เพิ่มสินค้าใหม่
├─ update.php # แก้ไขสินค้า
└─ delete.php # ลบสินค้า
```

---

## การติดตั้ง
1. ติดตั้ง **XAMPP** และ Start `Apache` + `MySQL`
2. Import ไฟล์ฐานข้อมูล `fruitstore.sql` ลง MySQL
3. วางโฟลเดอร์ `fruit-api` ใน:
   - macOS: `/Applications/XAMPP/htdocs/`
   - Windows: `C:\xampp\htdocs\`
4. แก้ไขไฟล์ `db.php` ให้ตรงกับ username/password ของ MySQL

---

## วิธีเรียกใช้งาน API

### 1. ดูสินค้าทั้งหมด
```
GET http://localhost/fruit-api/products/getAll.php
```
![](/JPG/GET.png)

### 2. ดูสินค้า 1 รายการ
```
GET http://localhost/fruit-api/products/getOne.php?id=1
```


### 3. เพิ่มสินค้าใหม่ (POST)
```
POST http://localhost/fruit-api/products/create.php

Content-Type: application/json
Body:
{
"name": "Peach",
"category": "Stone Fruit",
"price": 120.00,
"stock": 50,
"description": "ลูกพีชหวานฉ่ำ",
"image_url": "https://example.com/peach.jpg
"
}
```
![](/JPG/POST.png)

### 4. แก้ไขสินค้า (PUT)
```
PUT http://localhost/fruit-api/products/update.php?id=1

Content-Type: application/json
Body:
{
"name": "Apple Fuji Premium",
"category": "Apple",
"price": 55.00,
"stock": 90,
"description": "แอปเปิ้ลฟูจิคุณภาพพรีเมียม",
"image_url": "https://example.com/apple-fuji-premium.jpg
"
}
```
![](/JPG/PUT.png)

### 5. ลบสินค้า (DELETE)
DELETE http://localhost/fruit-api/products/delete.php?id=1
```

---

## ตัวอย่าง Response (JSON)
```json
[
  {
    "id": "1",
    "name": "Apple Fuji",
    "category": "Apple",
    "price": "45.00",
    "stock": "100",
    "description": "หวาน กรอบ จากญี่ปุ่น",
    "image_url": "https://example.com/apple-fuji.jpg"
  }
]

```
![](/JPG/DEL.png)


