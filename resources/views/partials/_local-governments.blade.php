<div class="form-group">
    <label>LGA</label>
    <select class="form-control" value="{{ old('lga') }}" name="lga" id="lga">
        <option selected disabled >Select LGA</option>
        @foreach($lgas as $lga)
            <option value="{{$lga->id}}">{{$lga->local_name ?? '' }}</option>
        @endforeach
    </select>
    @error('lga')
    <i class="text-danger mt-2">{{ $message }}</i>
    @enderror
</div>

