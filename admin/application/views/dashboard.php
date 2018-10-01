    <div class="row">
        <div class="span12">
            <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3> Last Tour Orders</h3>
                    <a href="/data-order"><button class="btn btn-primary btn-xs">See All</button></a>
                </div>
                <!-- /widget-header -->
                <div class="widget-content" ng-controller="latest_tour">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID Invoice</th>
                            <th>Email</th>
                            <th>Date Order</th>
                            <th>Date Tour</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                        <tr ng-repeat="x in tours">
                            <td><a href="/data-order/detail/{{x.id_invoice}}" target="_blank">{{x.id_invoice}}</a></td>
                            <td><a href="/users/detail/{{x.email_encode}}" target="_blank">{{x.user_email}}</a></td>
                            <td>{{x.date_order}}</td>
                            <td>{{x.date_tour}}</td>
                            <td>{{x.payment_method}}</td>
                            <td><label class="{{x.label}}">{{x.status}}</label></td>
                        </tr>
                    </table>
                    <div ng-show="loading"><img src="/assets/img/loading.gif" style="display:block; margin: 0 auto;"></div>
                </div>
            </div>
            <!-- /widget -->
        </div>
    </div>
    <div class="row">
        <div class="span6">
        <div class="widget widget-table action-table">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3> Last Confirmation Transfer</h3>
                    <a href="/data-order/confirmation-transfer"><button class="btn btn-primary btn-xs">See All</button></a>
                </div>
                <!-- /widget-header -->
                <div class="widget-content" ng-controller="latest_confirm">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>ID Invoice</th>
                            <th>Date Transfer</th>
                            <th>Status</th>
                        </tr>
                        <tr ng-repeat="x in confirm">
                            <td>{{x.id}}</td>
                            <td>{{x.email}}</td>
                            <td><a href="/data-order/detail/{{x.id_invoice}}" target="_blank">{{x.id_invoice}}</a></td>
                            <td>{{x.date_transfer}}</td>
                            <td><label class="label label-{{x.label}}">{{x.status}}</label></td>
                        </tr>
                    </table>
                    <div ng-show="loading"><img src="/assets/img/loading.gif" style="display:block; margin: 0 auto;"></div>
                </div>
            </div>
            <!-- /widget -->
        </div>

        <div class="span6">
            <div class="widget widget-nopad" ng-controller="latest_blog">
                <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3> Recent Blogs</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content">
                <div ng-show="loading"><img src="/assets/img/loading.gif" style="display:block; margin: 0 auto;"></div>
                <ul class="news-items">
                    <li ng-repeat="x in blogs">
                    <div class="news-item-date"> <span class="news-item-day">{{x.date}}</span> <span class="news-item-month">{{x.month}}</span> </div>
                    <div class="news-item-detail"> <a href="{{x.url}}" target="_blank" class="news-item-title" target="_blank">{{x.title}}</a>
                        <p class="news-item-preview">{{x.content}}</p>
                    </div>
                    </li>
                </ul>
                </div>
                <!-- /widget-content --> 
            </div>
            <!-- /widget -->
        </div>
    </div>