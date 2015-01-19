<?php
/**
 * Created by PhpStorm.
 * User: Princelo
 * Date: 12/23/14
 * Time: 10:31
 */
namespace Acme\BackendBundle\Entity;


class City {
    public $arrCity;

    public function getArrCity()
    {
        return json_decode('
            {"provinces":[{"id":"1","name":"\u5317\u4eac","cities":[{"2":"\u5317\u4eac\u5e02"}],"aid":"-1"},{"id":"21","name":"\u5929\u6d25","cities":[{"22":"\u5929\u6d25\u5e02"}],"aid":"-1"},{"id":"41","name":"\u6cb3\u5317","cities":[{"42":"\u77f3\u5bb6\u5e84\u5e02"},{"66":"\u5510\u5c71\u5e02"},{"81":"\u79e6\u7687\u5c9b\u5e02"},{"89":"\u90af\u90f8\u5e02"},{"109":"\u90a2\u53f0\u5e02"},{"129":"\u4fdd\u5b9a\u5e02"},{"155":"\u5f20\u5bb6\u53e3\u5e02"},{"173":"\u627f\u5fb7\u5e02"},{"185":"\u6ca7\u5dde\u5e02"},{"202":"\u5eca\u574a\u5e02"},{"213":"\u8861\u6c34\u5e02"}],"aid":"-1"},{"id":"225","name":"\u5c71\u897f","cities":[{"226":"\u592a\u539f\u5e02"},{"237":"\u5927\u540c\u5e02"},{"249":"\u9633\u6cc9\u5e02"},{"255":"\u957f\u6cbb\u5e02"},{"269":"\u664b\u57ce\u5e02"},{"276":"\u6714\u5dde\u5e02"},{"283":"\u664b\u4e2d\u5e02"},{"295":"\u8fd0\u57ce\u5e02"},{"309":"\u5ffb\u5dde\u5e02"},{"324":"\u4e34\u6c7e\u5e02"},{"342":"\u5415\u6881\u5e02"}],"aid":"-1"},{"id":"356","name":"\u5185\u8499\u53e4","cities":[{"357":"\u547c\u548c\u6d69\u7279\u5e02"},{"367":"\u5305\u5934\u5e02"},{"377":"\u4e4c\u6d77\u5e02"},{"381":"\u8d64\u5cf0\u5e02"},{"394":"\u901a\u8fbd\u5e02"},{"403":"\u9102\u5c14\u591a\u65af\u5e02"},{"413":"\u547c\u4f26\u8d1d\u5c14\u5e02"},{"427":"\u5df4\u5f66\u6dd6\u5c14\u5e02"},{"435":"\u4e4c\u5170\u5bdf\u5e03\u5e02"},{"447":"\u5174\u5b89\u76df"},{"454":"\u9521\u6797\u90ed\u52d2\u76df"},{"467":"\u963f\u62c9\u5584\u76df"}],"aid":"-1"},{"id":"471","name":"\u8fbd\u5b81","cities":[{"472":"\u6c88\u9633\u5e02"},{"486":"\u5927\u8fde\u5e02"},{"497":"\u978d\u5c71\u5e02"},{"505":"\u629a\u987a\u5e02"},{"513":"\u672c\u6eaa\u5e02"},{"520":"\u4e39\u4e1c\u5e02"},{"527":"\u9526\u5dde\u5e02"},{"535":"\u8425\u53e3\u5e02"},{"542":"\u961c\u65b0\u5e02"},{"550":"\u8fbd\u9633\u5e02"},{"558":"\u76d8\u9526\u5e02"},{"563":"\u94c1\u5cad\u5e02"},{"571":"\u671d\u9633\u5e02"},{"579":"\u846b\u82a6\u5c9b\u5e02"}],"aid":"-4"},{"id":"586","name":"\u5409\u6797","cities":[{"587":"\u957f\u6625\u5e02"},{"598":"\u5409\u6797\u5e02"},{"608":"\u56db\u5e73\u5e02"},{"615":"\u8fbd\u6e90\u5e02"},{"620":"\u901a\u5316\u5e02"},{"628":"\u767d\u5c71\u5e02"},{"635":"\u677e\u539f\u5e02"},{"641":"\u767d\u57ce\u5e02"},{"647":"\u5ef6\u8fb9\u671d\u9c9c\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-4"},{"id":"656","name":"\u9ed1\u9f99\u6c5f","cities":[{"657":"\u54c8\u5c14\u6ee8\u5e02"},{"676":"\u9f50\u9f50\u54c8\u5c14\u5e02"},{"693":"\u9e21\u897f\u5e02"},{"703":"\u9e64\u5c97\u5e02"},{"712":"\u53cc\u9e2d\u5c71\u5e02"},{"721":"\u5927\u5e86\u5e02"},{"731":"\u4f0a\u6625\u5e02"},{"749":"\u4f73\u6728\u65af\u5e02"},{"760":"\u4e03\u53f0\u6cb3\u5e02"},{"765":"\u7261\u4e39\u6c5f\u5e02"},{"776":"\u9ed1\u6cb3\u5e02"},{"783":"\u7ee5\u5316\u5e02"},{"794":"\u5927\u5174\u5b89\u5cad\u5730\u533a"}],"aid":"-4"},{"id":"802","name":"\u4e0a\u6d77","cities":[{"803":"\u4e0a\u6d77\u5e02"}],"aid":"-2"},{"id":"823","name":"\u6c5f\u82cf","cities":[{"824":"\u5357\u4eac\u5e02"},{"838":"\u65e0\u9521\u5e02"},{"847":"\u5f90\u5dde\u5e02"},{"859":"\u5e38\u5dde\u5e02"},{"867":"\u82cf\u5dde\u5e02"},{"879":"\u5357\u901a\u5e02"},{"888":"\u8fde\u4e91\u6e2f\u5e02"},{"896":"\u6dee\u5b89\u5e02"},{"905":"\u76d0\u57ce\u5e02"},{"915":"\u626c\u5dde\u5e02"},{"923":"\u9547\u6c5f\u5e02"},{"930":"\u6cf0\u5dde\u5e02"},{"937":"\u5bbf\u8fc1\u5e02"}],"aid":"-2"},{"id":"943","name":"\u6d59\u6c5f","cities":[{"944":"\u676d\u5dde\u5e02"},{"958":"\u5b81\u6ce2\u5e02"},{"970":"\u6e29\u5dde\u5e02"},{"982":"\u5609\u5174\u5e02"},{"990":"\u6e56\u5dde\u5e02"},{"996":"\u7ecd\u5174\u5e02"},{"1003":"\u91d1\u534e\u5e02"},{"1013":"\u8862\u5dde\u5e02"},{"1020":"\u821f\u5c71\u5e02"},{"1025":"\u53f0\u5dde\u5e02"},{"1035":"\u4e3d\u6c34\u5e02"}],"aid":"-2"},{"id":"1045","name":"\u5b89\u5fbd","cities":[{"1046":"\u5408\u80a5\u5e02"},{"1054":"\u829c\u6e56\u5e02"},{"1062":"\u868c\u57e0\u5e02"},{"1070":"\u6dee\u5357\u5e02"},{"1077":"\u9a6c\u978d\u5c71\u5e02"},{"1082":"\u6dee\u5317\u5e02"},{"1087":"\u94dc\u9675\u5e02"},{"1092":"\u5b89\u5e86\u5e02"},{"1104":"\u9ec4\u5c71\u5e02"},{"1112":"\u6ec1\u5dde\u5e02"},{"1121":"\u961c\u9633\u5e02"},{"1130":"\u5bbf\u5dde\u5e02"},{"1136":"\u5de2\u6e56\u5e02"},{"1142":"\u516d\u5b89\u5e02"},{"1150":"\u4eb3\u5dde\u5e02"},{"1155":"\u6c60\u5dde\u5e02"},{"1160":"\u5ba3\u57ce\u5e02"}],"aid":"-2"},{"id":"1168","name":"\u798f\u5efa","cities":[{"1169":"\u798f\u5dde\u5e02"},{"1183":"\u53a6\u95e8\u5e02"},{"1190":"\u8386\u7530\u5e02"},{"1196":"\u4e09\u660e\u5e02"},{"1209":"\u6cc9\u5dde\u5e02"},{"1222":"\u6f33\u5dde\u5e02"},{"1234":"\u5357\u5e73\u5e02"},{"1245":"\u9f99\u5ca9\u5e02"},{"1253":"\u5b81\u5fb7\u5e02"}],"aid":"-2"},{"id":"1263","name":"\u6c5f\u897f","cities":[{"1264":"\u5357\u660c\u5e02"},{"1274":"\u666f\u5fb7\u9547\u5e02"},{"1279":"\u840d\u4e61\u5e02"},{"1285":"\u4e5d\u6c5f\u5e02"},{"1298":"\u65b0\u4f59\u5e02"},{"1301":"\u9e70\u6f6d\u5e02"},{"1305":"\u8d63\u5dde\u5e02"},{"1324":"\u5409\u5b89\u5e02"},{"1338":"\u5b9c\u6625\u5e02"},{"1349":"\u629a\u5dde\u5e02"},{"1361":"\u4e0a\u9976\u5e02"}],"aid":"-2"},{"id":"1374","name":"\u5c71\u4e1c","cities":[{"1375":"\u6d4e\u5357\u5e02"},{"1386":"\u9752\u5c9b\u5e02"},{"1399":"\u6dc4\u535a\u5e02"},{"1408":"\u67a3\u5e84\u5e02"},{"1415":"\u4e1c\u8425\u5e02"},{"1421":"\u70df\u53f0\u5e02"},{"1434":"\u6f4d\u574a\u5e02"},{"1447":"\u6d4e\u5b81\u5e02"},{"1460":"\u6cf0\u5b89\u5e02"},{"1467":"\u5a01\u6d77\u5e02"},{"1472":"\u65e5\u7167\u5e02"},{"1477":"\u83b1\u829c\u5e02"},{"1480":"\u4e34\u6c82\u5e02"},{"1493":"\u5fb7\u5dde\u5e02"},{"1505":"\u804a\u57ce\u5e02"},{"1514":"\u6ee8\u5dde\u5e02"},{"1522":"\u83cf\u6cfd\u5e02"}],"aid":"-2"},{"id":"1532","name":"\u6cb3\u5357","cities":[{"1533":"\u90d1\u5dde\u5e02"},{"1546":"\u5f00\u5c01\u5e02"},{"1557":"\u6d1b\u9633\u5e02"},{"1573":"\u5e73\u9876\u5c71\u5e02"},{"1584":"\u5b89\u9633\u5e02"},{"1594":"\u9e64\u58c1\u5e02"},{"1600":"\u65b0\u4e61\u5e02"},{"1613":"\u7126\u4f5c\u5e02"},{"1625":"\u6fee\u9633\u5e02"},{"1632":"\u8bb8\u660c\u5e02"},{"1639":"\u6f2f\u6cb3\u5e02"},{"1645":"\u4e09\u95e8\u5ce1\u5e02"},{"1652":"\u5357\u9633\u5e02"},{"1666":"\u5546\u4e18\u5e02"},{"1676":"\u4fe1\u9633\u5e02"},{"1687":"\u5468\u53e3\u5e02"},{"1698":"\u9a7b\u9a6c\u5e97\u5e02"},{"3250":"\u6d4e\u6e90\u5e02"}],"aid":"-7"},{"id":"1709","name":"\u6e56\u5317","cities":[{"1710":"\u6b66\u6c49\u5e02"},{"1724":"\u9ec4\u77f3\u5e02"},{"1731":"\u5341\u5830\u5e02"},{"1740":"\u5b9c\u660c\u5e02"},{"1754":"\u8944\u6a0a\u5e02"},{"1764":"\u9102\u5dde\u5e02"},{"1768":"\u8346\u95e8\u5e02"},{"1774":"\u5b5d\u611f\u5e02"},{"1782":"\u8346\u5dde\u5e02"},{"1791":"\u9ec4\u5188\u5e02"},{"1802":"\u54b8\u5b81\u5e02"},{"1809":"\u968f\u5dde\u5e02"},{"1812":"\u6069\u65bd\u571f\u5bb6\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"1821":"\u7701\u76f4\u8f96\u53bf\u7ea7\u884c\u653f\u5355\u4f4d"}],"aid":"-7"},{"id":"1826","name":"\u6e56\u5357","cities":[{"1827":"\u957f\u6c99\u5e02"},{"1837":"\u682a\u6d32\u5e02"},{"1847":"\u6e58\u6f6d\u5e02"},{"1853":"\u8861\u9633\u5e02"},{"1866":"\u90b5\u9633\u5e02"},{"1879":"\u5cb3\u9633\u5e02"},{"1889":"\u5e38\u5fb7\u5e02"},{"1899":"\u5f20\u5bb6\u754c\u5e02"},{"1904":"\u76ca\u9633\u5e02"},{"1911":"\u90f4\u5dde\u5e02"},{"1923":"\u6c38\u5dde\u5e02"},{"1935":"\u6000\u5316\u5e02"},{"1948":"\u5a04\u5e95\u5e02"},{"1954":"\u6e58\u897f\u571f\u5bb6\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-7"},{"id":"1963","name":"\u5e7f\u4e1c","cities":[{"1964":"\u5e7f\u5dde\u5e02"},{"1977":"\u97f6\u5173\u5e02"},{"1988":"\u6df1\u5733\u5e02"},{"1995":"\u73e0\u6d77\u5e02"},{"1999":"\u6c55\u5934\u5e02"},{"2007":"\u4f5b\u5c71\u5e02"},{"2013":"\u6c5f\u95e8\u5e02"},{"2021":"\u6e5b\u6c5f\u5e02"},{"2031":"\u8302\u540d\u5e02"},{"2038":"\u8087\u5e86\u5e02"},{"2047":"\u60e0\u5dde\u5e02"},{"2053":"\u6885\u5dde\u5e02"},{"2062":"\u6c55\u5c3e\u5e02"},{"2067":"\u6cb3\u6e90\u5e02"},{"2074":"\u9633\u6c5f\u5e02"},{"2079":"\u6e05\u8fdc\u5e02"},{"2088":"\u4e1c\u839e\u5e02"},{"2089":"\u4e2d\u5c71\u5e02"},{"2090":"\u6f6e\u5dde\u5e02"},{"2094":"\u63ed\u9633\u5e02"},{"2100":"\u4e91\u6d6e\u5e02"},{"3251":"\u4e1c\u6c99\u5e02"}],"aid":"-3"},{"id":"2106","name":"\u5e7f\u897f","cities":[{"2107":"\u5357\u5b81\u5e02"},{"2120":"\u67f3\u5dde\u5e02"},{"2131":"\u6842\u6797\u5e02"},{"2149":"\u68a7\u5dde\u5e02"},{"2157":"\u5317\u6d77\u5e02"},{"2162":"\u9632\u57ce\u6e2f\u5e02"},{"2167":"\u94a6\u5dde\u5e02"},{"2172":"\u8d35\u6e2f\u5e02"},{"2178":"\u7389\u6797\u5e02"},{"2185":"\u767e\u8272\u5e02"},{"2198":"\u8d3a\u5dde\u5e02"},{"2203":"\u6cb3\u6c60\u5e02"},{"2215":"\u6765\u5bbe\u5e02"},{"2222":"\u5d07\u5de6\u5e02"}],"aid":"-3"},{"id":"2230","name":"\u6d77\u5357","cities":[{"2231":"\u6d77\u53e3\u5e02"},{"2236":"\u4e09\u4e9a\u5e02"},{"2237":"\u7701\u76f4\u8f96\u53bf\u7ea7\u884c\u653f\u5355\u4f4d"},{"3252":"\u767d\u6c99"},{"3253":"\u4fdd\u4ead"},{"3254":"\u660c\u6c5f"},{"3255":"\u6f84\u8fc8"},{"3256":"\u510b\u5dde"},{"3257":"\u5b9a\u5b89"},{"3258":"\u4e1c\u65b9"},{"3259":"\u4e50\u4e1c"},{"3260":"\u4e34\u9ad8"},{"3261":"\u9675\u6c34"},{"3262":"\u743c\u6d77"},{"3263":"\u743c\u4e2d"},{"3264":"\u4e09\u6c99"},{"3265":"\u5c6f\u660c"},{"3266":"\u4e07\u5b81"},{"3267":"\u6587\u660c"},{"3268":"\u4e94\u6307\u5c71"}],"aid":"-3"},{"id":"2257","name":"\u91cd\u5e86\u5e02","cities":[{"2258":"\u91cd\u5e86\u5e02"}],"aid":"-6"},{"id":"2299","name":"\u56db\u5ddd","cities":[{"2300":"\u6210\u90fd\u5e02"},{"2320":"\u81ea\u8d21\u5e02"},{"2327":"\u6500\u679d\u82b1\u5e02"},{"2333":"\u6cf8\u5dde\u5e02"},{"2341":"\u5fb7\u9633\u5e02"},{"2348":"\u7ef5\u9633\u5e02"},{"2358":"\u5e7f\u5143\u5e02"},{"2366":"\u9042\u5b81\u5e02"},{"2372":"\u5185\u6c5f\u5e02"},{"2378":"\u4e50\u5c71\u5e02"},{"2390":"\u5357\u5145\u5e02"},{"2400":"\u7709\u5c71\u5e02"},{"2407":"\u5b9c\u5bbe\u5e02"},{"2418":"\u5e7f\u5b89\u5e02"},{"2424":"\u8fbe\u5dde\u5e02"},{"2432":"\u96c5\u5b89\u5e02"},{"2441":"\u5df4\u4e2d\u5e02"},{"2446":"\u8d44\u9633\u5e02"},{"2451":"\u963f\u575d\u85cf\u65cf\u7f8c\u65cf\u81ea\u6cbb\u5dde"},{"2465":"\u7518\u5b5c\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"2484":"\u51c9\u5c71\u5f5d\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-6"},{"id":"2502","name":"\u8d35\u5dde","cities":[{"2503":"\u8d35\u9633\u5e02"},{"2514":"\u516d\u76d8\u6c34\u5e02"},{"2519":"\u9075\u4e49\u5e02"},{"2534":"\u5b89\u987a\u5e02"},{"2541":"\u94dc\u4ec1\u5730\u533a"},{"2552":"\u9ed4\u897f\u5357\u5e03\u4f9d\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"2561":"\u6bd5\u8282\u5730\u533a"},{"2570":"\u9ed4\u4e1c\u5357\u82d7\u65cf\u4f97\u65cf\u81ea\u6cbb\u5dde"},{"2587":"\u9ed4\u5357\u5e03\u4f9d\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-6"},{"id":"2600","name":"\u4e91\u5357","cities":[{"2601":"\u6606\u660e\u5e02"},{"2616":"\u66f2\u9756\u5e02"},{"2626":"\u7389\u6eaa\u5e02"},{"2636":"\u4fdd\u5c71\u5e02"},{"2642":"\u662d\u901a\u5e02"},{"2654":"\u4e3d\u6c5f\u5e02"},{"2660":"\u666e\u6d31\u5e02"},{"2671":"\u4e34\u6ca7\u5e02"},{"2680":"\u695a\u96c4\u5f5d\u65cf\u81ea\u6cbb\u5dde"},{"2691":"\u7ea2\u6cb3\u54c8\u5c3c\u65cf\u5f5d\u65cf\u81ea\u6cbb\u5dde"},{"2705":"\u6587\u5c71\u58ee\u65cf\u82d7\u65cf\u81ea\u6cbb\u5dde"},{"2714":"\u897f\u53cc\u7248\u7eb3\u50a3\u65cf\u81ea\u6cbb\u5dde"},{"2718":"\u5927\u7406\u767d\u65cf\u81ea\u6cbb\u5dde"},{"2731":"\u5fb7\u5b8f\u50a3\u65cf\u666f\u9887\u65cf\u81ea\u6cbb\u5dde"},{"2737":"\u6012\u6c5f\u5088\u50f3\u65cf\u81ea\u6cbb\u5dde"},{"2742":"\u8fea\u5e86\u85cf\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-6"},{"id":"2746","name":"\u897f\u85cf","cities":[{"2747":"\u62c9\u8428\u5e02"},{"2756":"\u660c\u90fd\u5730\u533a"},{"2768":"\u5c71\u5357\u5730\u533a"},{"2781":"\u65e5\u5580\u5219\u5730\u533a"},{"2800":"\u90a3\u66f2\u5730\u533a"},{"2811":"\u963f\u91cc\u5730\u533a"},{"2819":"\u6797\u829d\u5730\u533a"}],"aid":"-6"},{"id":"2827","name":"\u9655\u897f","cities":[{"2828":"\u897f\u5b89\u5e02"},{"2842":"\u94dc\u5ddd\u5e02"},{"2847":"\u5b9d\u9e21\u5e02"},{"2860":"\u54b8\u9633\u5e02"},{"2875":"\u6e2d\u5357\u5e02"},{"2887":"\u5ef6\u5b89\u5e02"},{"2901":"\u6c49\u4e2d\u5e02"},{"2913":"\u6986\u6797\u5e02"},{"2926":"\u5b89\u5eb7\u5e02"},{"2937":"\u5546\u6d1b\u5e02"}],"aid":"-5"},{"id":"2945","name":"\u7518\u8083","cities":[{"2946":"\u5170\u5dde\u5e02"},{"2955":"\u5609\u5cea\u5173\u5e02"},{"2956":"\u91d1\u660c\u5e02"},{"2959":"\u767d\u94f6\u5e02"},{"2965":"\u5929\u6c34\u5e02"},{"2973":"\u6b66\u5a01\u5e02"},{"2978":"\u5f20\u6396\u5e02"},{"2985":"\u5e73\u51c9\u5e02"},{"2993":"\u9152\u6cc9\u5e02"},{"3001":"\u5e86\u9633\u5e02"},{"3010":"\u5b9a\u897f\u5e02"},{"3018":"\u9647\u5357\u5e02"},{"3028":"\u4e34\u590f\u56de\u65cf\u81ea\u6cbb\u5dde"},{"3037":"\u7518\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-5"},{"id":"3046","name":"\u9752\u6d77","cities":[{"3047":"\u897f\u5b81\u5e02"},{"3055":"\u6d77\u4e1c\u5730\u533a"},{"3062":"\u6d77\u5317\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"3067":"\u9ec4\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"3072":"\u6d77\u5357\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"3078":"\u679c\u6d1b\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"3085":"\u7389\u6811\u85cf\u65cf\u81ea\u6cbb\u5dde"},{"3092":"\u6d77\u897f\u8499\u53e4\u65cf\u85cf\u65cf\u81ea\u6cbb\u5dde"}],"aid":"-5"},{"id":"3098","name":"\u5b81\u590f","cities":[{"3099":"\u94f6\u5ddd\u5e02"},{"3106":"\u77f3\u5634\u5c71\u5e02"},{"3110":"\u5434\u5fe0\u5e02"},{"3115":"\u56fa\u539f\u5e02"},{"3121":"\u4e2d\u536b\u5e02"}],"aid":"-5"},{"id":"3125","name":"\u65b0\u7586","cities":[{"3126":"\u4e4c\u9c81\u6728\u9f50\u5e02"},{"3135":"\u514b\u62c9\u739b\u4f9d\u5e02"},{"3140":"\u5410\u9c81\u756a\u5730\u533a"},{"3144":"\u54c8\u5bc6\u5730\u533a"},{"3145":"\u660c\u5409\u56de\u65cf\u81ea\u6cbb\u5dde"},{"3153":"\u535a\u5c14\u5854\u62c9\u8499\u53e4\u81ea\u6cbb\u5dde"},{"3157":"\u5df4\u97f3\u90ed\u695e\u8499\u53e4\u81ea\u6cbb\u5dde"},{"3167":"\u963f\u514b\u82cf\u5730\u533a"},{"3177":"\u514b\u5b5c\u52d2\u82cf\u67ef\u5c14\u514b\u5b5c\u81ea\u6cbb\u5dde"},{"3182":"\u5580\u4ec0\u5730\u533a"},{"3195":"\u548c\u7530\u5730\u533a"},{"3204":"\u4f0a\u7281\u54c8\u8428\u514b\u81ea\u6cbb\u5dde"},{"3215":"\u5854\u57ce\u5730\u533a"},{"3223":"\u963f\u52d2\u6cf0\u5730\u533a"},{"3269":"\u963f\u62c9\u5c14"},{"3270":"\u963f\u52d2\u6cf0"},{"3271":"\u77f3\u6cb3\u5b50"},{"3272":"\u56fe\u6728\u8212\u514b"},{"3273":"\u4e94\u5bb6\u6e20"}],"aid":"-5"},{"id":"3243","name":"\u53f0\u6e7e","cities":[{"3244":"\u53f0\u6e7e"}],"aid":"-1"},{"id":"3245","name":"\u9999\u6e2f","cities":[{"3246":"\u9999\u6e2f"}],"aid":"-1"},{"id":"3247","name":"\u6fb3\u95e8","cities":[{"3248":"\u6fb3\u95e8"}],"aid":"-1"}]}
        ');
    }

    public function getArrProvinces(){
        $arrCity = $this->getArrCity();
        $arrCity = $arrCity->provinces;
        $arrProvinces = array();
        foreach($arrCity as $k => $v){
            $arrProvinces[$v->id] = $v->name;
        }
        return $arrProvinces;
    }

    public function getAvailableCities($intProvinceId){
        $cities = array();
        if($intProvinceId != null){
            $arrCity = $this->getArrCity();
            $arrCity = $arrCity->provinces;
            foreach($arrCity as $k => $v){
                //$arrProvinces[$v->id] = $v->name;
                if($v->id == $intProvinceId){
                    foreach($arrCity[$k]->cities as $ik => $iv)
                        foreach($iv as $iik => $iiv){
                            $cities[$iik] = $iiv;
                        }
                }
            }
        }
        //echo json_encode($cities);exit;
        return $cities;
    }

    public function getAllCities(){
        $cities = array();
        $arrCity = $this->getArrCity()->provinces;
        foreach($arrCity as $k => $v){
            foreach($arrCity[$k]->cities as $ik => $iv)
                foreach($iv as $iik => $iiv)
                    $cities[$iik] = $iiv;
        }
        return $cities;
    }

    public function getStrProvinceName($id)
    {
        $arrCity = $this->getArrCity()->provinces;
        foreach($arrCity as $k => $v)
        {
            if($arrCity[$k]->id == $id)
                return $arrCity[$k]->name;
        }
        return '未知省份';
    }

    public function getStrCityName($id)
    {
        $arrCity = $this->getArrCity();
        foreach($arrCity->provinces as $k => $v)
            foreach($arrCity->provinces[$k]->cities as $ik => $iv)
                foreach($arrCity->provinces[$k]->cities[$ik] as $iik => $iiv)
                    if($iik == $id)
                        return $iiv;
        return '未知城市';
    }

}