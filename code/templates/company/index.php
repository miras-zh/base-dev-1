<?php
/**
 * @var array $companies
 * @var string $content
 * @var int $totalAmount
 * @var string $valueName
 * @var string $valueBin
 * @var string $valueRegion
 */
$limits = ['5', '10', '20', '30', '50', '100', '200', '500', '1000'];
$title = 'Company list';

$count = (int)($_GET['count'] ?? 30);
$totalPage = ceil($totalAmount / $count);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<div class="mt-1 mb-1">
    <span style="font-size: 12px" class="badge bg-dark text-black float-center">Раздел в разработке</span>
    <span style="font-size: 12px" class="badge bg-info text-white float-center">сейчас этот раздел дорабатывается,технические работы...</span>
</div>
<div class="w-100" style="margin-top: 20px;overflow-x: scroll;">
    <div class="flex-row d-flex w-100 justify-content-between">
        <div><h4>Список компании</h4></div>
        <div>
            <a href="/companies/create" class="btn" style="background: #3b8ad0; color: whitesmoke"><i
                        class="bi bi-plus-square-fill mx-1"></i>Создать компанию</a>
        </div>
    </div>
    <div class="card mt-1 mb-2 mx-1 p-3">
        <form action="/companies?page=1&&count=30" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="company_bin_filter" class="form-label">БИН</label>
                        <input name="company_bin_filter" value="<?= $valueBin ?>" class="form-control" type="text"
                               placeholder="Введите БИН" id="company_bin_filter">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="company_name_filter" class="form-label">Наименование</label>
                        <input value="<?= $valueName ?>" class="form-control" type="text"
                               placeholder="введите название организации" name="company_name_filter"
                               id="company_name_filter">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="company_region_filter" class="form-label">Регион</label>
                        <input class="form-control" type="text" placeholder="Введите регион" id="company_region_filter"
                               name="company_region_filter" value="<?= $valueRegion ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="billing-zip-postal" class="form-label">Почтовый индекс</label>
                        <input class="form-control" type="text" placeholder="почтовый индекс" id="billing-zip-postal">
                    </div>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label class="form-label">Страна</label>
                        <select data-toggle="select2" title="Country" dataEnter your zip
                                code-select2-id="select2-data-1-le76" tabindex="-1" class="select2-hidden-accessible"
                                aria-hidden="true">
                            <option value="0" data-select2-id="select2-data-3-jppb">Select Country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia (Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint LUCIA</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre and Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                       data-select2-id="select2-data-2-8hft" style="width: 206px;"><span
                                    class="selection"><span class="select2-selection select2-selection--single"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            title="Country" tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-hlk3-container"
                                                            aria-controls="select2-hlk3-container"><span
                                            class="select2-selection__rendered" id="select2-hlk3-container"
                                            role="textbox" aria-readonly="true"
                                            title="Select Country">Выбрать страну</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" class="mx-5 mt-3 btn bg-primary">Поиск</button>
                </div>
            </div> <!-- end row -->
        </form>
    </div>
    <div class="d-flex flex-row mt-4 mb-3">
        <div class="form-group d-flex flex-row align-items-center mr-10" style="width: 140px;">
            <label class="w-50" for="count">строки:</label>
            <div class="btn-group">
                <?php $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; ?>
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false"> <?= $count ?> <span class="caret"></span></button>
                <div class="dropdown-menu">
                    <?php foreach ($limits as $item): ?>
                        <?php
                        $next_page_url = http_build_query(array_merge($_GET, ['page' => 1, 'count' => $item]));
                        echo "<a class='dropdown-item' href='/companies?$next_page_url'>" . $item . "</a>";
                        ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="my-1 px-1 d-flex flex-row mb-2 flex-wrap align-items-center">
            <?php
            echo "<a class='btn border-white mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?page=1&count=30'>all</a>";
            for ($btn = 1; $btn <= $totalPage; $btn++) {
                $next_page_url = http_build_query(array_merge($_GET, ['page' => $btn, 'count' => $count]));

                if ($btn == 1 && $currentPage !== $btn) {
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?$next_page_url'>$btn</a>";
                    if ($currentPage - 4 >= 1) {
                        echo "..";
                    }
                }

                if (($btn > $currentPage && ($btn - $currentPage) <= 3) && $btn != $totalPage && $btn !== 1 || ($btn < $currentPage && ($currentPage - $btn) <= 3 && $btn != $totalPage && $btn !== 1)) {
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke; width: fit-content;height: 30px;' href='/companies?$next_page_url'>$btn</a>";
                }

                if ($currentPage === $btn) {
                    echo "<a class='btn border-white mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #3b8ad0; color: black; font-weight: bold;' href='/companies?$next_page_url'>$btn</a>";
                }
                if ($btn == $totalPage && $currentPage !== $btn) {
                    if (($totalPage - $currentPage) > 4) {
                        echo "..";
                    }
                    echo "<a class='btn mx-1 d-flex align-items-center justify-content-center' style='cursor:pointer;background: #494d4d; color: whitesmoke' href='/companies?$next_page_url'>$btn</a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Показать
            с <?= ((int)$currentPage - 1) * (int)$count + 1 ?>
            по <?= $count * ($currentPage) > $totalAmount ? $totalAmount : $count * ($currentPage) ?>
            из <?= $totalAmount ?> компаний
        </div>
    </div>
    <div>
        <table id="fixed-header-datatable" class="table dt-responsive nowrap table-striped w-100">
            <thead>
            <tr>
                <th>ID</th>
                <th>Наименование</th>
                <th>Адрес</th>
                <th>Регион</th>
                <th>Контакты</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($companies as $key => $company): ?>
                <tr>
                    <th scope="row"><?php echo $company['id']; ?></th>
                    <td style="width: 350px">
                        <?php
                        echo $company['company_name'] . "<br>";
//                        echo "<span style='font-size: 14px;background-color: #004c7a !important;' class='text-white float-center'>" . "БИН " . "</span>";
                        echo "<span style='font-size: 14px;padding:0px 4px;background-color: #0d78b5 !important;' class='text-white float-center'> " . $company['company_bin'] . "</span>";
                        ?>
                    </td>
                    <td style="width: 350px"><?php echo $company['address']; ?></td>
                    <td><?php echo $company['region']; ?></td>
                    <td>
                        <?php
                        $phone_numbers = explode(',', $company['phone']);
                        echo $company['email'] . "<br>";
                        foreach ($phone_numbers as $phone){
                            echo "<span class='text-white float-center green-badge'><i class='mdi mdi-phone'></i> " . $phone. "</span><br>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="/companies/info/<?= $company['id'] . "?page=$currentPage&count=$count" ?>"
                           class="btn mx-1 item-action">
                            <i class="mdi mdi-information-off" style="font-size: 20px"></i>
                        </a>
                        <a href="/companies/edit/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-lead-pencil" style="font-size: 20px"></i>
                        </a>
                        <a href="/companies/delete/<?= $company['id'] ?>" class="btn mx-1 item-action">
                            <i class="mdi mdi-delete" style="font-size: 20px"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Показать
                    с <?= ((int)$currentPage - 1) * (int)$count + 1 ?>
                    по <?= $count * ($currentPage) > $totalAmount ? $totalAmount : $count * ($currentPage) ?>
                    из <?= $totalAmount ?> компаний
                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">
                    <ul class="pagination pagination-rounded">
                        <li class="paginate_button page-item previous disabled" id="basic-datatable_previous">
                            <a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                        <?php
                        for ($btn = 1; $btn <= $totalPage; $btn++) {
                        $next_page_url = http_build_query(array_merge($_GET, ['page' => $btn, 'count' =>$count]));
                        if($btn == 1 && $currentPage !== $btn){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";
                            if($currentPage-4>=1){echo "..";}
                        }

                        if(($btn > $currentPage && ($btn-$currentPage)<=3) && $btn != $totalPage && $btn !== 1|| ($btn <
                        $currentPage && ($currentPage-$btn)<=3 && $btn != $totalPage && $btn !== 1)){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";}

                        if($currentPage === $btn){
                        echo "
                        <li class='paginate_button page-item active'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if( $btn == $totalPage && $currentPage !== $btn){
                        if(($totalPage-$currentPage) > 4){ echo "..";}
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        }
                        if($btn > $currentPage && ($btn-$currentPage)<3){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if($btn < $currentPage && ($currentPage-$btn)<3){
                        echo "
                        <li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>
                        ";
                        }
                        if($currentPage === $btn){
                        echo "
                        <li class='paginate_button page-item active'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";}
                        if(($totalPage-$currentPage) > 4 && $btn == $totalPage){
                        echo "..";
                        echo "<li class='paginate_button page-item'>
                            <a href='/companies?$next_page_url' aria-controls='basic-datatable' data-dt-idx='1'
                               tabindex='0' class='page-link'>$btn</a>
                        </li>";
                        }
                        ?>
                        <li class="paginate_button page-item next" id="basic-datatable_next">
                            <a href="#" aria-controls="basic-datatable" data-dt-idx="7" tabindex="0" class="page-link">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const selElement = document.querySelector('.count-row-table');
    const urlParams = new URLSearchParams(window.location.search);
    selElement.value = urlParams.get('count');
    selElement.addEventListener('change', () => {
        window.location.search = `?page=1&count=${selElement.value}`
    })
</script>


