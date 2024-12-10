<?php

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
         * Retrieve the list of available products.
         *
         * @group External
         * @authenticated
         * @response 200 [
         *     { "id": 1, "name": "Product A", "price": 10.99 },
         *     { "id": 2, "name": "Product B", "price": 12.49 }
         * ]
         *
         * @example bash curl -X GET "https://example.com/api/v1/external/products" -H "Authorization: Bearer YOUR_TOKEN"
         * @example javascript fetch("https://example.com/api/v1/external/products", {
         *     method: "GET",
         *     headers: { "Authorization": "Bearer YOUR_TOKEN" }
         * })
         * @example python import requests
         * response = requests.get("https://example.com/api/v1/external/products", headers={"Authorization": "Bearer YOUR_TOKEN"})
         * print(response.json())
         * @example php $ch = curl_init("https://example.com/api/v1/external/products");
         * curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer YOUR_TOKEN"]);
         * curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         * $response = curl_exec($ch);
         * curl_close($ch);
         * echo $response;
         */
        Route::get('/products', function () {
            return response()->json([
                ['id' => 1, 'name' => 'Product A', 'price' => 10.99],
                ['id' => 2, 'name' => 'Product B', 'price' => 12.49],
            ]);
        });
    });
});
