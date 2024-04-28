@extends('layouts.dashboard.app')

@section('content') 
    <div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <!-- Search Form -->
       
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">الاشتراكات </h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                                               
                        @if($inviteStatus)             
                        <label>دفع قيمة الدعوة</label>
                        <form action="{{ route('invitation.addedMoney') }}" method="post">
                        @csrf    
                        <input type="hidden" class="form-control" id="cust_id" name="cust_id" value="{{$inviteStatus->invited_id}}" />
                        <input type="hidden" class="form-control" id="invited_id" name="invited_id" value="{{$inviteStatus->id}}" />
                        <input type="number" class="form-control" id="amount" name="amount" value="50" placeholder="50" />
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
           
                        @endif
                        <!-- Subscription Cards -->
                        @if($subscriptions->count() > 0)
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach($subscriptions as $subscription)                                
                                    <div class="col">
                                        <div class="card h-100 border-primary bg-light">
                                            <div class="card-header bg-primary text-white text-center">
                                                @if($subscription->status == 'pending')
                                                <h5>طلب اشتراك </h5>
                                                @else
                                                <h5>اشتراك مفعل</h5>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><strong class="text-primary">  {{ optional($subscription->customer)->name }}:</strong>اسم العميل</li>
                                                    <li class="list-group-item"><strong class="text-info">رقم الهاتف :</strong> {{ $subscription->phone_number }}</li>
                                                    <li class="list-group-item"><strong class="text-success">تاريخ الاشتراك :</strong> {{ $subscription->created_at }}</li>
                                                    <li class="list-group-item"><strong class="text-danger">تاريخ انتهاء الاشتراك :</strong> {{ $subscription->Subscription_End_Date }}</li>
                                                    <li class="list-group-item"><strong class="text-success">صوره التحقق :</strong> <img  style="width: 266px; height: 220px;" src="{{asset('images/dashboard/subscriptions/'.$subscription->photo)}}"></li> 
                                                </ul>
                                            </div>
                                            <!-- Add your update form or any other actions here -->
                                            <div class="card-footer bg-light text-center"> <!-- توسيط العناصر بالمنتصف -->
                                               @if($subscription->status == 'pending')
                                                <form action="{{ route('subscriptions.active', $subscription->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-lg confirm-subscription-btn">رد الاشتراك</button>
                                                </form>
                                                @else
                                                <form action="{{ route('subscriptions.cancel', $subscription->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-lg confirm-subscription-btn">إلغاء الاشتراك</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                 
                                    
                                @endforeach
                            </div>
                        @else
                            <p class="text-center">لا يوجد حتى الآن</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
