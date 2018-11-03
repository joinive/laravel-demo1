<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Solarium\Client as SolrClient;

class SolrController extends Controller
{

    /**
     * 首页全文搜索
     * @return \Illuminate\Support\Collection
     */
    public function searchProduct(Request $request){
        $data = $request->all();
        $key=$data['key'];//搜索传入的字段
        if(isset($data['page']) && !empty($data['page'])){//page是第几页
            if($data['page']==1){
                $start=0;
            }else{
                $start=($data['page']-1)*15;
            }
        }else{
            $start=0;
        }
        if(isset($data['order']) && !empty($data['order'])){//我这里的order是用于根据什么排序
            if($data['order']==4){
                $sort=['sale_price','asc'];
            }else{
                $sort=['id','asc'];
            }
        }else{
            $sort=['id','asc'];
        }

        if(isset($data['sale_price']) && !empty($data['sale_price'])){//筛选价格范围
            $price_start=$data['sale_price']['start'];
            $price_end=$data['sale_price']['end'];

        }else{
            $price_start='*';
            $price_end='*';
        }
        //solr数据库配置
        $options = [
            'endpoint' => [
                'localhost' => [
                    'host' => '127.0.0.1',  //IP地址
                    'port' => 9090,         //端口号
                    'core' => null,
                    'path' => '/solr/product',//solr 索引库位置
                    'wt'=>'json',
                ],
            ],
        ];

        $client = new SolrClient($options);//实例化 solr类
        $query = $client->createSelect();//创建查询
        $query->setStart($start);//用于分页 从第几条取，初始0
        $query->setRows("15");//用于分页 每次取多少条
        $query->setQuery($key);// 筛选条件
        //筛选价格范围
        $query->createFilterQuery('sale_price')->setQuery('sale_price:['.$price_start.' TO '.$price_end.']');

        //筛选的品牌
        if(isset($data['brand']) && !empty($data['brand'])) {
            $query->createFilterQuery('brandName')->setQuery('brandName:'.$data['brand']);
        }
        if(isset($data['first_cat_name']) && !empty($data['first_cat_name'])) {//分类查询
            $query->createFilterQuery('first_cat_name')->setQuery('first_cat_name:'.$data['first_cat_name']);//筛选产品分类
        }
        $query->addSort($sort[0],$sort[1]);//排序
        $query->setQueryDefaultField("name");//默认筛选 key 的字段名字，我这里是查产品名字


        $facetSet = $query->getFacetSet();// facet 开启，facet 是用于 查询符合筛选的全部产品的分组，比如我搜索了 “海康”，取了 第一页 15条数据，它会另外返回我一个 符合筛选条件的数据的全部品牌分组
        if(!isset($data['brand'])) {
            $facetSet->createFacetField('brand')->setField('brand');//facet 获得品牌分组
        }
        if(!isset($data['first_cat_name'])) {
            $facetSet->createFacetField('first_cat_name')->setField('first_cat_name');//facet获得分类分组
        }

        $resultset = $client->select($query);// 查询 执行
        if(!isset($data['brand'])) {
            $resultset->getFacetSet()->getFacet('brand');//facet 在select 执行前 set,在select执行后需要再 get 一下
        }
        if(!isset($data['first_cat_name'])) {
            $resultset->getFacetSet()->getFacet('first_cat_name');
        }

        $response= $resultset->getData();//取数据
        $response=(array)$response;

        return $this->success(200 ,$response);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $config = config('solr.config');
//        $config = config('app.locale');
//        dd($config);
        $config = [

            'endpoint' => [
                'localhost'=> [
                    'hostname' => 'localhost',
                    'port' => 9090,
                    'core' => null,
                    'path' => '/solr/db',
                    'wt' => 'json'
                ]
            ]

        ];
        $client = new SolrClient($config);
        $query = $client->createSelect();

        //$facetSet = $query->getFacetSet();
        //$facetSet->createFacetField('stock')->setField('inStock');

        $resultset = $client->select($query);
        echo 'NumFound: '.$resultset->getNumFound() . PHP_EOL;

//        $facet = $resultset->getFacetSet()->getFacet('stock');
//        foreach ($facet as $value => $count) {
//            echo $value . ' [' . $count . ']' . PHP_EOL;
//        }

        foreach ($resultset as $document) {
            echo $document->id . PHP_EOL;
            echo $document->username . PHP_EOL;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
