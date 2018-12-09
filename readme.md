# TrustOcean as ACME API
 
一个 [TrustOcean API](https://api.trustocean.com/?from=github-trustocean-acme) 转 [ACME API](https://tools.ietf.org/html/draft-ietf-acme-acme-09) 的项目

## 安装

```bash
git clone https://github.com/xiaohuilam/trustocean-acme.git ./
cp .env.example .env
composer install
php artisan key:generate
php artisan serve
```
修改 `.env` 中的 TRUSTOCEAN_USERNAME 和 TRUSTOCEAN_PASSWORD 为你本人的 trustocean 的账号。

然后将你的 acme 客户端的 api endpoint 修改成 localhost，即可正常使用。

## 完成度
1%

## License
MIT