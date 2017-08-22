<script>
    function FillBilling(f) {
  if(f.billingtoo.checked == true) {
    f.communication_address.value = f.permanent_address.value;
    f.communication_district.value = f.permanent_district.value;
    f.communication_state.value = f.permanent_state.value;
    f.communication_zip_pin.value = f.permanent_zip_pin.value;
  }
    if(f.billingtoo.checked == false) {
    f.communication_address.value = '';
    f.communication_district.value = '';
    f.communication_state.value = '';
    f.communication_zip_pin.value = '';
  }
}

  </script>