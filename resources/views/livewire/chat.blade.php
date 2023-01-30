<div class="row justify-content-center align-items-start">

    <aside class="col-12 col-lg-4 rounded-4 border card">
        <div class="card-body px-0" wire:poll>
            <h3>{{ __('lang.messages') }}</h3> {{ !$chats->count() ? __('lang.No Data') : '' }}
            <ul class="mt-3 pr-0" id="userMenue">
                @foreach ($chats as $chat)
                    @if ($chat->messages->count())
                        @if ($chat->user && $chat->sender)
                            <li class="{{ $chat->id == $chatId->id ? 'mainBgColor' : '' }} border rounded-2 d-flex"
                                wire:click="chatShow({{ $chat->id }})" style="justify-content: space-between">
                                <div class="">
                                    <img src="{{ $chat->sender_id == $user->id ? $chat->user->getUserAvatar() : $chat->sender->getUserAvatar() }}"
                                        alt="" width="60" height="60">
                                    <div>
                                        <h6>{{ $chat->sender_id == $user->id ? $chat->user->name : $chat->sender->name }}
                                        </h6>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn text-end font-3 text-danger"
                                        wire:click="delete({{ $chat->id }})"><span
                                            class="fal fa-trash"></span></button>
                                </div>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>
    <main class="col-12 col-lg-6 card ms-2" wire:poll>
        <ul id="chat" class="card-body">
            @if ($chatId && $chatId->user && $chatId->sender)
                
                @foreach ($chatId->messages as $message)
                    <li class="{{ $message->sender_id == $user->id ? 'me' : 'you' }} my-3">
                        <div class="entete mt-2">
                            <span><img
                                    src="{{ $message->sender_id == $user->id ? $message->sender->getUserAvatar() : $message->user->getUserAvatar() }}"
                                    alt="" width="40" height="40" class="rounded-circle"></span>
                            <span style="font-size: 15px !important">{{ $message->created_at->diffforhumans() }}</span>
                        </div>
                        <div style="font-size: 15px !important"
                            class="{{ $message->sender_id == $user->id ? 'mainBgColor' : '' }}  border rad14 message text-start">
                            {{-- {!! $message->file ?? $message->message  !!} --}}
                            {{-- File --}}
                            @if($message->file)
                            <div class="chat-file">
                                 <a href="{{asset("storage/uploads/chatFiles/" . $message->file)}}" style="width: 80%; font-size:40px; padding: 10px 0;text-align:right;" download><i class="fas fa-file"></i></a>
                            </div>
                            {{-- Photo --}}
                            @elseif($message->photo)
                             <div class="card" class="chat-file image">
                                <img width="100" height="100" src="{{asset("storage/uploads/chatFiles/" . $message->photo)}}" class="card-img-top">
                            </div> 

                            {{-- Text --}}
                            @else
                            {!!$message->message!!}
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="col-12 my-3">
            <form name="chat" wire:submit.prevent="send_msg" class="row" style="justify-content: space-between">
                
                {{-- Message --}}
                <input wire:model="msg" class="col-8 px-3 py-2 border rad14 d-inline-block"
                    placeholder="{{ __('lang.Send') }}">
                
                {{-- File --}}
                <label for="file" style="background-color: {{$settings->main_color()}};" class="input-custom"><i class="fal fa-paperclip"></i></label>
                <input type="file" style="display: none" id="file" wire:model="file">
                
                {{-- Submit --}}
                <button class="col-3 btn d-inline-block rad14 mainBgColor" type="submit" >{{ __('lang.Send') }} <i
                    class="fas fa-paper-plane"></i> </button>
                
                {{-- Errors --}}
                @error('msg') <span class="d-block text-danger w-100 py-1">{{ $message }}</span>@enderror
                @error('file') <span class="d-block text-danger w-100 py-1 error">{{ $message }}</span> @enderror

            </form>
        </div>
    </main>
</div>
