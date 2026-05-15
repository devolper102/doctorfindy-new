<div class="dc-widget dc-onlineoptions">

    <div class="dc-doclocation dc-doclocationvtwo">
        <span>
            <i class="ti-direction-alt"></i>{{$user->location->title}}
        </span> 
        <span>
            <i class="ti-calendar"></i>
          
            @if(!empty($available_days))
          
                @foreach($available_days as $available_day)
                    <em class="dc-available"> {{ucfirst($available_day)}}, </em>
                @endforeach
                @else
                <em class="dc-dayon"> Null </em>
            @endif
        </span> 
        @php 
        $count = DB::table('feedbacks')->count();
        $total = 0;
        if ($user->profile->votes > 0 && $count > 0) {
            $total = ($user->profile->votes / $count)*100;
        }
        @endphp    
        <span>
    <i class="ti-thumb-up"></i>{{round($total, 0)}}% Satisfied Patient
        </span> 
         @if($user->profile->starting_price !=0)
        <span>
            <i class="ti-wallet"></i>{{ trans('lang.starting_from') }} Rs {{$user->profile->starting_price}}
        </span>
         @else
         <span>
            <i class="ti-wallet"></i>{{ trans('lang.starting_from') }} Rs 0
        </span>
        @endif
        @php
            $day = strtolower(date('D'));
            if ($available_days) {
                if (in_array($day,$available_days)) {
                    $availability = '<em class="dc-available">Available Today</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +1 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available Today</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +2 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available on '.date('l', strtotime(' +2 day')).'</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +3 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available on '.date('l', strtotime(' +3 day')).'</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +4 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available on '.date('l', strtotime(' +4 day')).'</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +5 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available on '.date('l', strtotime(' +5 day')).'</em>';
                }
                elseif ( in_array(strtolower(date('D', strtotime(' +6 day'))), $available_days) ) {
                    $availability = '<em class="dc-available">Available on '.date('l', strtotime(' +6 day')).'</em>';
                }
                $availble = true;
            }
            else {
                $availble = false;
            }
        @endphp
        <span>
            <i class="ti-clipboard"></i>
                @if($availble)
                <em class="dc-available">
                    {!! $availability !!}
                </em>
                @else
                 <em class="dc-dayon">
                    Not Available Today
                    </em>
                @endif
        </span>
    </div>
</div>
