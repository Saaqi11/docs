<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    /**
     * Generate OAuth Token.
     *
     * This endpoint generates an OAuth token for clients.
     *
     * @group Authentication
     * @bodyParam clientId string required The client ID provided to the user. Example: "12345"
     * @bodyParam clientSecret string required The client secret key associated with the client ID. Example: "abcde"
     * @bodyParam Scopes array scopes for the generated token. Example: ["read:products"]
     * @response {
     *   "access_token": "abcd1234",
     *   "token_type": "Bearer",
     *   "expires_in": 3600
     * }
     *
     * @example bash curl -X POST "https://example.com/api/v1/oauth/generate" -d "clientId=12345" -d "clientSecret=abcde" -d "scopes[]=read:products"
     * @example javascript fetch("https://example.com/api/v1/oauth/generate", {
     *     method: "POST",
     *     headers: { "Content-Type": "application/x-www-form-urlencoded" },
     *     body: new URLSearchParams({ clientId: "12345", clientSecret: "abcde", scopes: "read:products" })
     * })
     * @example python import requests
     * response = requests.post("https://example.com/api/v1/oauth/generate", data={"clientId": "12345", "clientSecret": "abcde", "scopes": ["read:products"]})
     * print(response.json())
     * @example php $ch = curl_init("https://example.com/api/v1/oauth/generate");
     * curl_setopt($ch, CURLOPT_POST, true);
     * curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
     *     "clientId" => "12345",
     *     "clientSecret" => "abcde",
     *     "scopes" => ["read:products"]
     * ]));
     * curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     * $response = curl_exec($ch);
     * curl_close($ch);
     * echo $response;
     */
    Route::post('/oauth/token', function () {
        // This is just a placeholder route for Scribe documentation.
    });

    Route::prefix('external')->middleware(['auth:api'])->group(function () {
        /**
         * Get Products.
         *
         * Retrieve the list of available products based on the given address.
         *
         * @group External
         * @authenticated
         * @queryParam address required string Address filter for the products. Example: "New York"
         * @queryParam office_id optional string office_id filter for the products. Example: "123"
         * @response 200 {
         *     "productId": "0081060702497",
         *     "upc": "0081060702497",
         *     "productPageURI": "/p/popcorners-popped-corn-snack-variety-pack/0081060702497?cid=dis.api.tpi_products-api_20240521_b:all_c:p_t:tello-7b0598e99da674",
         *     "brand": "PopCorners",
         *     "categories": [
         *         "Natural & Organic",
         *         "Snacks"
         *     ],
         *     "countryOrigin": "UNITED STATES",
         *     "description": "PopCorners® Popped Corn Snack Variety Pack",
         *     "images": [
         *         {
         *             "perspective": "right",
         *             "sizes": [
         *                 { "size": "xlarge", "url": "https://www.kroger.com/product/images/xlarge/right/0081060702497" },
         *                 { "size": "large", "url": "https://www.kroger.com/product/images/large/right/0081060702497" }
         *             ]
         *         },
         *         {
         *             "perspective": "front",
         *             "featured": true,
         *             "sizes": [
         *                 { "size": "xlarge", "url": "https://www.kroger.com/product/images/xlarge/front/0081060702497" }
         *             ]
         *         }
         *     ],
         *     "items": [
         *         {
         *             "itemId": "0081060702497",
         *             "favorite": false,
         *             "fulfillment": {
         *                 "curbside": true,
         *                 "delivery": true,
         *                 "inStore": true,
         *                 "shipToHome": false
         *             },
         *             "price": {
         *                 "regular": 12.99,
         *                 "promo": 10.49
         *             },
         *             "size": "15 ct / .63 oz",
         *             "soldBy": "UNIT"
         *         }
         *     ],
         *     "itemInformation": {
         *         "depth": "5.5",
         *         "height": "11.88",
         *         "width": "10.13"
         *     },
         *     "temperature": {
         *         "indicator": "Ambient",
         *         "heatSensitive": false
         *     },
         *     "price": "16.89"
         * }
         * @example bash curl -X GET "https://example.com/api/v1/external/products?address=New%20York" -H "Authorization: Bearer YOUR_TOKEN"
         * @example javascript fetch("https://example.com/api/v1/external/products?address=New%20York", {
         *     method: "GET",
         *     headers: { "Authorization": "Bearer YOUR_TOKEN" }
         * })
         */
        Route::get('/products', function (Request $request) {
            $address = $request->query('address');

            // Return an error response if address is not provided
            if (!$address) {
                return response()->json(['error' => 'The address parameter is required.'], 400);
            }

            return response()->json([
                "productId" => "0081060702497",
                "upc" => "0081060702497",
                "productPageURI" => "/p/popcorners-popped-corn-snack-variety-pack/0081060702497?cid=dis.api.tpi_products-api_20240521_b:all_c:p_t:tello-7b0598e99da674",
                "brand" => "PopCorners",
                "categories" => ["Natural & Organic", "Snacks"],
                "countryOrigin" => "UNITED STATES",
                "description" => "PopCorners® Popped Corn Snack Variety Pack",
                "images" => [
                    [
                        "perspective" => "right",
                        "sizes" => [
                            ["size" => "xlarge", "url" => "https://www.kroger.com/product/images/xlarge/right/0081060702497"],
                            ["size" => "large", "url" => "https://www.kroger.com/product/images/large/right/0081060702497"]
                        ]
                    ],
                    [
                        "perspective" => "front",
                        "featured" => true,
                        "sizes" => [
                            ["size" => "xlarge", "url" => "https://www.kroger.com/product/images/xlarge/front/0081060702497"]
                        ]
                    ]
                ],
                "items" => [
                    [
                        "itemId" => "0081060702497",
                        "favorite" => false,
                        "fulfillment" => [
                            "curbside" => true,
                            "delivery" => true,
                            "inStore" => true,
                            "shipToHome" => false
                        ],
                        "price" => [
                            "regular" => 12.99,
                            "promo" => 10.49
                        ],
                        "size" => "15 ct / .63 oz",
                        "soldBy" => "UNIT"
                    ]
                ],
                "itemInformation" => [
                    "depth" => "5.5",
                    "height" => "11.88",
                    "width" => "10.13"
                ],
                "temperature" => [
                    "indicator" => "Ambient",
                    "heatSensitive" => false
                ],
                "price" => "16.89"
            ]);
        });

        /**
         * Store an Order.
         *
         * This endpoint stores an order with the provided details, including products, address, fees, and delivery time.
         *
         * @group External
         * @authenticated
         * @bodyParam productData array required List of products in the order. Example: [{"name": "Product 1", "size": "1 kg",  "image": "image-url", "price": 10.5, "quantity": 2}]
         * @bodyParam guestNotes string required Additional notes from the guest. Example: "Leave it at the front door."
         * @bodyParam alcoholFee number required Alcohol-related fee for the order. Example: 5.00
         * @bodyParam address string required The delivery address for the order. Example: "123 Main St, New York, NY"
         * @bodyParam deliveryTime string required Delivery time for the order. Example: "15:00"
         * @bodyParam deliveryDate string required Delivery date for the order. Example: "2025-02-01"
         * @bodyParam guestEmail string required Email of the guest. Example: "guest@example.com"
         * @bodyParam guestPhoneNumber string required Phone number of the guest. Example: "555-123-4567"
         * @bodyParam driverFee number required Fee for the driver. Example: 10.00
         * @bodyParam entryInstructions string optional Instructions for entering the building. Example: "Call me when you arrive."
         * @response 200 {
         *   "status": "Order created successfully",
         *   "data": {
         *       orderId: "12345"
         *   }
         * }
         * @response 400 {
         *   "error": "Invalid input or missing required fields."
         * }
         * @response 500 {
         *   "error": "Server error occurred while processing the order."
         * }
         *
         * @example bash curl -X POST "https://example.com/api/v1/external/order" -d "productData=[{\"productId\":\"001\",\"price\":10.5,\"quantity\":2}]" -d "dob=1990-01-01" -d "idType=passport" -d "address=123 Main St, New York, NY" -d "deliveryTime=15:00" -d "deliveryDate=2025-02-01" -d "guestEmail=guest@example.com" -d "guestPhoneNumber=555-123-4567"
         * @example javascript fetch("https://example.com/api/v1/external/order", {
         *     method: "POST",
         *     headers: { "Authorization": "Bearer YOUR_TOKEN", "Content-Type": "application/json" },
         *     body: JSON.stringify({
         *         productData: [{"productId": "001", "price": 10.5, "quantity": 2}],
         *         dob: "1990-01-01",
         *         idType: "passport",
         *         address: "123 Main St, New York, NY",
         *         deliveryTime: "15:00",
         *         deliveryDate: "2025-02-01",
         *         guestEmail: "guest@example.com",
         *         guestPhoneNumber: "555-123-4567"
         *     })
         * })
         */
        Route::post('/order', function () {

        });
    });


});
