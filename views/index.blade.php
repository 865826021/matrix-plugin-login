<div class="login-box" ng-controller="MatrixLoginCtrl">
    <div class="login-logo">
        <a ng-href="@{{ '/' | url }}">{!! config('matrix.logo.normal') !!}</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <form name="form">
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="邮箱" autofocus="autofocus" required
                       ng-model="data.email" ng-model-options="{ debounce: 100 }"
                       ui-validate-async="{notExists: 'checkEmail($modelValue)'}">
                <span ng-show='form.email.$error.notExists'>邮箱不存在</span>
                <span ng-show='form.email.$pending'>邮箱验证中...</span>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密码" required
                       ng-model="data.password" ng-model-options="{ debounce: 100 }"
                       ui-validate="{password: 'checkPassword($value)'}">
                <span ng-show='form.password.$error.password'>密码为6-30个字符组成</span>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button ng-if="form.$valid" ng-click="services.matrixLogin.login(data)"
                            class="btn btn-primary btn-block btn-flat">登录
                    </button>
                    <button ng-if="!form.$valid" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
                <div class="col-xs-6">
                    <a ng-href="@{{ '/register' | url }}" class="btn btn-default btn-block btn-flat">注册新用户</a>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>