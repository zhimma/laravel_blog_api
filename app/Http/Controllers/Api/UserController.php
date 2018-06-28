<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends ApiController
{
    public function getToken(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:1|max:255',
            'password' => 'required|min:6|max:255'
        ]);
        if (!$token = JWTAuth::attempt($request->all())) {
            return response(['error' => 'Account or password error.'], 400);
        }

        return $this->setAuthenticationHeader($token);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return $this->success($user);
    }

    protected function setAuthenticationHeader($token = null)
    {
        $token = $token ?: $this->auth->refresh();

        $menuModel = new Menu();
        $menus = $menuModel->getMenuTree();
        /*{
            path: '/',
            component: Layout,
            children: [
                {path: '/index', component: Index, name: 'index', class: 'fa-line-chart'},
                {path: '/menu', component: menuPage, name: 'menu', class: 'fa-line-chart'},
                {path: '/system-setting', component: systemSetting, name: 'systemSetting', class: 'fa-line-chart'},
            ]
        },*/
        $routerData = [];
        foreach ($menus as $key => $value) {
            $router['path'] = $value['url'];
            $router['component'] = $value['component'];
            if (isset($value['_child'])) {
                foreach ($value['_child'] as $k => $v) {
                    $router['children'][] = [
                        'path'      => $v['url'],
                        'component' => $v['component'],
                        'name'      => $v['alias'],
                        'class'     => $v['icon'],
                    ];
                }

            }
            array_push($routerData, $router);
        }

        return $this->setHeader(['Authorization' => 'Bearer ' . $token])->success($routerData);
//        return response()->json(['success' => true], 200)->header('Authorization', 'Bearer ' . $token);//注意'Bearer '这里有一个空格

    }

}
