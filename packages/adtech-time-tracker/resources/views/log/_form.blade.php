<form id="logwork-form">
        <div class="d-flex justify-content-between">
            <div>
                <p class="text-center">Date</p>
                <input type="text" class="form-control" id="log-date" value="{{ date('d-m-Y') }}" tabindex="1" value="{{ $log->logged_at }}"/>
            </div>

            <div>
                <p class="text-center">Time spent (4w 2h 2d)</p>
                <input type="text" class="form-control" id="time-spent" tabindex="2" value="{{ $log->time_spent }}"/>
            </div>

            <div>
                <p >&nbsp;</p>
                <button type="submit" class="btn btn-primary" id="log-work">Log work</button>
            </div>
        </div>
        <div>
            <p>Description</p>
            <textarea class="form-control" id="description" tabindex="3">{{ $log->description }}</textarea>
        </div>
    </form>
