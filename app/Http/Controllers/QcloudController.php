<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qcloud\Cos\B

class QcloudController extends Controller
{
    //
    public function test(Request $request) {

        $cosClient = new Qcloud\Cos\Client(array(
            'region' => 'COS_REGION', #地域，如ap-guangzhou,ap-beijing-1
            'credentials' => array(
                'secretId' => 'AKID97qNefL1MRGJ7fy0nMgkY7QZS6VeDBet',
                'secretKey' => 'EDwWqvnRq1xf9OO8dsrc8O6atypRp0wd',
            ),
        ));

// 若初始化 Client 时未填写 appId，则 bucket 的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
        $bucket = 'lewzyLU02-1252448703';
        $key = 'a.txt';
        $local_path = "E:/a.txt";
# 上传文件
## putObject(上传接口，最大支持上传5G文件)
### 上传内存中的字符串
        try {
            $result = $cosClient->putObject(array(
                'Bucket' => $bucket,
                'Key' => $key,
                'Body' => 'Hello World!'
            ));
            print_r($result);
            # 可以直接通过$result读出返回结果
            echo ($result['ETag']);
        } catch (\Exception $e) {
            echo($e);
        }

        ### 上传文件流
        try {
            $result = $cosClient->putObject(array(
                'Bucket' => $bucket,
                'Key' => $key,
                'Body' => fopen($local_path, 'rb')
            ));
            print_r($result);
        } catch (\Exception $e) {
            echo($e);
        }


    }
}
