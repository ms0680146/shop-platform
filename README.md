# shop platform
## 目標：
設計一個購物車的優惠系統，包含訂單內描述優惠的方式與後台優惠項目的設定方式 

## 優惠方式：
1. 特定商品滿 X 件折 Y 元或 Z %
2. 訂單滿 X 元折 Y 元或 Z %
3. 訂單滿 X 元免運費
4. 訂單滿 X 贈送特定商品
5. 特定供應商場品滿 X 件折 Y 元或 Z %
6. 折扣可限定總共只套用 N 次或總共優惠 Y 元
7. 折扣可限定每人只套用 N 次或總共優惠 Y 元
8. 折扣可限制特定時間內有效或是每月重新計算使用數量限制

## DB Tables：
users: 使用者
shops: 供應商店家
products: 商品(贈品和一般商品共用)
product_stocks: 商品庫存(不同顏色尺寸會有多個)
shopping_carts: 購物車
orders: 訂單
order_items: 訂單項目
sale_strategies: 優惠策略(管理所有優惠，依照 type 區分不同類型的優惠:商品,供應商,訂單,折價卷)
vi_shop_sale_strategies: 供應商店家-優惠策略(多對多)
vi_user_coupons: 使用者-優惠策略(多對多)



## API: 
```
Route: [GET] /api/orders/calc
參數
coupon_id: integer，優惠卷ID
回傳
status: 200:成功, 400:使用者沒有購物車, 404:購物車內為空
message: success, bad request, not found
data: caclOrder, product_strategies, shop_strategies, order_strategies, coupon_strategies
```
