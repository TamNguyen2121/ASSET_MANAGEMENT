<div>
    <option value=""></option>
    @foreach ($equipment_type1 as $data)
        @php
            printEquipmentType($data, ' ');
        @endphp
    @endforeach
</div>
@php
    function printEquipmentType($equipment_type, $prefix = '')
    {
        echo '<option value="' . $equipment_type->id . '">' . $prefix . $equipment_type->name . '</option>';
        if ($equipment_type->children) {
            foreach ($equipment_type->children as $child) {
                printEquipmentType($child, $prefix . '-');
            }
        }
    }
@endphp
{{-- <div>
    <option value=""></option>
    @foreach ($equipment_type1 as $data)
        @php
            printEquipmentType($data, ' ');
        @endphp
    @endforeach
</div>

@php
    function printEquipmentType($equipment_type, $prefix = '')
    {
        echo '<option value="' . $equipment_type->id . '">' . $prefix . $equipment_type->name . '</option>';

        if (isset($equipment_type->children)) {
            foreach ($equipment_type->children as $child) {
                printEquipmentType($child, $prefix . '-');
            }
        }
    }
@endphp --}}

