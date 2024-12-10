# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_ACCESS_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

To authenticate, you need an access token. You can generate one by sending a POST request to the `/api/v1/oauth/generate` endpoint with the required parameters: `clientId`, `clientSecret`, and `scopes`.
