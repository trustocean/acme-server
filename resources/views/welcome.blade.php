<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ACME.dev.trustocean.com</title>

        <!-- Fonts -->
        <link href="https://lib.sinaapp.com/js/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                max-width: 510px;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                display: inline-block;
                margin-top: 30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            div, pre, h2 {
                width: 100%;
            }
            pre, h2, .desc-content {
                max-width: 800px;
                display: inline-block;
            }

            #trustoceanseal {
                width: 98px;
                height: 36px;
            }
            body {
                margin: 0
            }

            a {
                color: #24292e;
                text-decoration: none;
                outline: 0
            }

            .octicon {
                display: inline-block;
                vertical-align: text-top;
                fill: currentColor
            }

            .widget {
                display: inline-block;
                overflow: hidden;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
                font-size: 0;
                white-space: nowrap;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none
            }

            .btn, .social-count {
                display: inline-block;
                height: 14px;
                padding: 2px 5px;
                font-size: 11px;
                font-weight: 600;
                line-height: 14px;
                vertical-align: bottom;
                cursor: pointer;
                border: 1px solid #c5c9cc;
                border-radius: 0.25em
            }

            .btn {
                background-color: #eff3f6;
                background-image: -webkit-linear-gradient(top, #fafbfc, #eff3f6 90%);
                background-image: -moz-linear-gradient(top, #fafbfc, #eff3f6 90%);
                background-image: linear-gradient(180deg, #fafbfc, #eff3f6 90%);
                background-position: -1px -1px;
                background-repeat: repeat-x;
                background-size: 110% 110%;
                border-color: rgba(27, 31, 35, 0.2);
                -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFFAFBFC', endColorstr='#FFEEF2F5')";
                *filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFFAFBFC', endColorstr='#FFEEF2F5')
            }

            .btn:active {
                background-color: #e9ecef;
                background-image: none;
                border-color: #a5a9ac;
                border-color: rgba(27, 31, 35, 0.35);
                box-shadow: inset 0 0.15em 0.3em rgba(27, 31, 35, 0.15)
            }

            .btn:focus, .btn:hover {
                background-color: #e6ebf1;
                background-image: -webkit-linear-gradient(top, #f0f3f6, #e6ebf1 90%);
                background-image: -moz-linear-gradient(top, #f0f3f6, #e6ebf1 90%);
                background-image: linear-gradient(180deg, #f0f3f6, #e6ebf1 90%);
                border-color: #a5a9ac;
                border-color: rgba(27, 31, 35, 0.35);
                -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFF0F3F6', endColorstr='#FFE5EAF0')";
                *filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#FFF0F3F6', endColorstr='#FFE5EAF0')
            }

            .social-count {
                position: relative;
                margin-left: 5px;
                background-color: #fff
            }

            .social-count:focus, .social-count:hover {
                color: #0366d6
            }

            .social-count b, .social-count i {
                position: absolute;
                top: 50%;
                left: 0;
                display: block;
                width: 0;
                height: 0;
                margin: -4px 0 0 -4px;
                border: solid transparent;
                border-width: 4px 4px 4px 0;
                _line-height: 0;
                _border-top-color: red !important;
                _border-bottom-color: red !important;
                _border-left-color: red !important;
                _filter: chroma(color=red)
            }

            .social-count b {
                border-right-color: #c5c9cc
            }

            .social-count i {
                margin-left: -3px;
                border-right-color: #fff
            }

            .lg .btn, .lg .social-count {
                height: 28px;
                padding: 5px 10px;
                font-size: 12px;
            }

            .lg .social-count {
                margin-left: 6px
            }

            .lg .social-count b, .lg .social-count i {
                margin: -5px 0 0 -5px;
                border-width: 5px 5px 5px 0
            }

            .lg .social-count i {
                margin-left: -4px
            }
        </style>
    </head>
    <body class="container">
        <div class="position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="https://console.trustocean.com/templates/lagom/assets/img/logo/logo_big.svg" style="width: 40%"/>
                    <span style="width:60%">ACME</span>
                </div>
                <p>
                    <span class="widget lg">
                        <a class="btn" href="https://github.com/trustocean" target="_blank" aria-label="Follow @trustocean  on GitHub">
                            <svg version="1.1" width="16" height="16" viewBox="0 0 16 16" class="octicon octicon-mark-github" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
                            <span>Follow @trustocean</span>
                        </a>
                        <a class="social-count" href="https://github.com/trustocean/followers" target="_blank" aria-label="0 follower on GitHub">
                            <b></b>
                            <i></i>
                            <span id="followers">NaN</span>
                        </a>
                    </span>
                    <span class="widget lg">
                        <a class="btn" href="https://github.com/trustocean/acme-server" target="_blank" aria-label="Star trustocean/acme-client on GitHub">
                            <svg version="1.1" width="14" height="16" viewBox="0 0 14 16" class="octicon octicon-star" aria-hidden="true"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path></svg>
                            <span>Star</span>
                        </a>
                        <a class="social-count" href="https://github.com/trustocean/acme-server/stargazers" target="_blank" aria-label="1 stargazer on GitHub">
                            <b></b>
                            <i></i>
                            <span id="stargazers_count">NaN</span>
                        </a>
                    </span>
                </p>
                <h2 class="text-left">安装使用 <small>目前不支持其他 ACME 客户端</small></h2><br/>
                <pre class="text-left">
wget https://git.io/acmephp -O ~/acme
wget https://git.io/acmephp.yml -O ~/acmephp.yml

#修改权限为可执行
chmod -R 755 ~/acme

#修改你的域名和域名挑战信息 (见"#配置"说明)
vim ~/acmephp.yml

#申请证书
~/acme run ~/acmephp.yml -v --server={{route('acme.directory')}}
</pre>
                <h2 class="text-left">配置 <small>配置 acmephp.yml 说明</small></h2><br/>
                <pre class="text-left">
contact_email: londry@qiaoke.com #联系邮箱

certificates:
  # DNSPod 验证 key 需要在 https://console.cloud.tencent.com/cam/capi 获取访问秘钥
  - domain: "*.domain1.com" #主域名，支持单域名、通配。但通配域名必须加双引号
    subject_alternative_names:
      - "*.domain2.com" #额外域名，证书的DNS字段，可以支持通配
    solver:
      name: dnspod #支持 http-file、gandi、dnspod、aliyun
      secret_id: *** #额外参数，不同的 solver 需要的参数不一样。
      secret_key: ***


  # AliyunDNS 验证 key 需要在 https://usercenter.console.aliyun.com/#/manage/ak 获取访问秘钥
  - domain: "*.domain1.com" #主域名，支持单域名、通配。但通配域名必须加双引号
    subject_alternative_names:
      - "*.domain2.com" #额外域名，证书的DNS字段，可以支持通配
    solver:
      name: dnspod #支持 http-file、gandi、dnspod、aliyun
      secret_id: *** #额外参数，不同的 solver 需要的参数不一样。
      secret_key: ***

  # HTTP 文件验证
  - domain: www.domain3.com
    subject_alternative_names:
      - www2.domain3.com
    solver:
      name: http-file # http文件验证
      adapter: sftp # http文件验证的适配器，由flysystem实现。支持sftp、ftp、local、
      root: /Project/nginx/www.domain3.com/public # web根目录
      host: www.domain3.com # 服务器主机。如果域名走了CDN，务必改成源IP
      username: root # sftp的登陆名
      privateKey: /Users/londry/.ssh/id_rsa # sftp登陆秘钥

  # 申请成功后自动部署到 CDN 等服务, 或者 FTP/SFTP 推送到服务器
  - domain: www.domain3.com
    subject_alternative_names:
      - www2.domain3.com
    solver:
      //...
    install:
      # 安装行为 action支持 install_aws_elb、 install_aws_elbv2、 install_aliyun_cdn、 install_aliyun_waf、push_ftp、push_sftp
      - action: install_aliyun_cdn
        region: cn-hangzhou
        domain: www.domain3.com
        accessKeyId: ***
        accessKeySecret: ***
      - action: install_aliyun_waf
        region: eu-west-1
        instanceId: waf-instanceid
        domain: www2.domain3.com
        accessKeyId: ***
        accessKeySecret: ***
</pre>
            </div>
        </div>
        <script src="https://lib.sinaapp.com/js/jquery/1.12.4/jquery-1.12.4.min.js"></script>
        <script>
            $.getJSON('https://api.github.com/repos/trustocean/acme-server', function (json) {
                $('#stargazers_count').text(json.stargazers_count);
            });
            $.getJSON('https://api.github.com/users/trustocean', function (json) {
                $('#followers').text(json.followers);
            });
            
        </script>
    </body>
</html>
