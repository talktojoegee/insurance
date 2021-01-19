<select name="policy_no" id="policy_no" class="form-control js-example-basic-single">
    <option disabled selected>--Select policy no. --</option>
    @foreach ($policies as $policy)
        <option value="{{$policy->policy_number}}">{{$policy->policy_number ?? ''}}</option>
    @endforeach
</select>
