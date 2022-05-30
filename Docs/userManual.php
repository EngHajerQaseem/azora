<?php
include("include/header.php");
?>


<section class="manual">
    <div class="container">
        <?php 
    if($_SESSION["language"] == "ar_EG"){
        echo '
        <div class="row">
            <div class="col-md-3">
                <div class="nav-wrapper">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-tour-tab" data-toggle="pill" href="#v-pills-tour"
                            role="tab" aria-controls="v-pills-tour" aria-selected="true">جولة بالنظام</a>

                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                            role="tab" aria-controls="v-pills-home" aria-selected="false">لوحة المتابعة</a>

                        <a class="nav-link " id="v-pills-pos-tab" data-toggle="pill" href="#v-pills-pos"
                            role="tab" aria-controls="v-pills-pos" aria-selected="true">نقطة البيع</a>

                        <a class="nav-link " id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category"
                            role="tab" aria-controls="v-pills-category" aria-selected="true">الاصناف</a>

                        <a class="nav-link " id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product"
                            role="tab" aria-controls="v-pills-product" aria-selected="true">المنتجات</a>

                        <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase"
                            role="tab" aria-controls="v-pills-purchase" aria-selected="false">المشتريات</a>

                        <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab"
                            aria-controls="v-pills-sales" aria-selected="false">المبيعات</a>

                        <a class="nav-link" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory"
                            role="tab" aria-controls="v-pills-inventory" aria-selected="false">المخزون</a>

                        <a class="nav-link" id="v-pills-expenses-tab" data-toggle="pill" href="#v-pills-expenses"
                            role="tab" aria-controls="v-pills-expenses" aria-selected="false">المصروفات</a>

                        <a class="nav-link" id="v-pills-report-tab" data-toggle="pill" href="#v-pills-report" role="tab"
                            aria-controls="v-pills-report" aria-selected="false">التقارير</a>

                        <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer"
                            role="tab" aria-controls="v-pills-customer" aria-selected="false">الزبائن</a>

                        <a class="nav-link" id="v-pills-supplier-tab" data-toggle="pill" href="#v-pills-supplier"
                            role="tab" aria-controls="v-pills-supplier" aria-selected="false">الموردين</a>

                        <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab"
                            aria-controls="v-pills-user" aria-selected="false">المستخدمين</a>

                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                            role="tab" aria-controls="v-pills-settings" aria-selected="false">الاعدادات</a>
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-tour" role="tabpanel"
                aria-labelledby="v-pills-tour-tab">
                <h1>جولة بالنظام</h1>
                <div class="tab-details">
                <h3>- طلب شراء جديد</h3>
                <div class="tab-img">
                    <img src="../layout/images/tour1.png" alt="azora-dashboard" />
                </div>
                <p>1-	قم بالنقر على زر طلب شراء للجديد للقيام بعملية الشراء</p>

                    <div class="tab-img">
                    <img src="../layout/images/tour2.png" alt="azora-dashboard" />
                </div>
                <p>2-	قم باختيار اسم المورد من قائمة الموردين <br>
                3-	قم باختيار المنتج الذي تريد اضافتة للمخزون</p>


                    <div class="tab-img">
                    <img src="../layout/images/tour3.png" alt="azora-dashboard" />
                </div>
                <p>4-	في حقل السعر قم باضافة سعر الشراء <br>
                5-	في حقل وحدة القياس قم باضافة وحدة قياس الكمية <br>
                6-	قم باضافة سعر البيع <br>
                7-	قم باضافة المبلغ الاجمالي في حقل المدفوع <br>
                </p>

                    <div class="tab-img">
                    <img src="../layout/images/tour4.png" alt="azora-dashboard" />
                </div>
                <p class="pb-5">8-	يمكنك الغاء العملية من خلال الضغط على زر الالغاء<br>
                9-	يمكنك حفظ العملية عن طريق النقر على زر الحفظ
                .</p>


            </div>


            <div class="tab-details">
                <h3>- اضافة منتج جديد</h3>
                <div class="tab-img">
                    <img src="../layout/images/tourbuy1.png" alt="azora-dashboard" />
                </div>
                <p>1-	قم بالضغط على زر اضافة منتج</p>

                    <div class="tab-img">
                    <img src="../layout/images/tourbuy2.png" alt="azora-dashboard" />
                </div>
                <p  class="pb-5">2-	في واجهة الاضافة قم باضافة اسم المنتج في الحقل الخاص بالاضافة.<br>
                3-	في حقل الباركود قم باضافة الباركود الخاص بالمنتج.<br>
                4-	قم باختيار الصنف من القائمة المنسدلة.<br>
                5-	بعد اختيار الصنف قم باختيار الصنف الفرعي الخاص بالمنتج.<br>
                6-	قم باختيار وحدة العد.<br>
                7-	قم باضافة سعر المنتج في حقل السعر.<br>
                8-	في حال تواجد ضريبة قم باضافتها في حق الضريبة.<br>
                9-	يمكنك اضافة وصف خاص بالمنتج في حال تواجد وصف.<br>
                10-	عند النقر على الصوره يمكنك اختيار صورة خاصه بالمنتج.<br>
                11-	قم بحفظ البيانات المدخلة.<br>
                12-	عند الضغط على الألغاء يتم تجاهل الخطوات السابقة.
                </p>


            </div>


            <div class="tab-details">
            <h3>- بيع المنتجات</h3>
            <div class="tab-img">
                <img src="../layout/images/toursell1.png" alt="azora-dashboard" />
            </div>
            <p>1-	قم بالضغط على زر اضافة منتج</p>
            
            <div class="tab-img">
            <img src="../layout/images/toursell2.png" alt="azora-dashboard" />
            </div>
             <p>1-	قم بالضغط على زر اضافة منتج</p>
        
          <div class="tab-img">
            <img src="../layout/images/toursell3.png" alt="azora-dashboard" />
          </div>
           <p>1-	قم بالضغط على زر اضافة منتج</p>

         <div class="tab-img">
            <img src="../layout/images/toursell4.png" alt="azora-dashboard" />
         </div>
           <p>1-	قم بالضغط على زر اضافة منتج</p>

           <div class="tab-img">
            <img src="../layout/images/toursell5.png" alt="azora-dashboard" />
         </div>
           <p>1-	قم بالضغط على زر اضافة منتج</p>

        <div class="tab-img">
          <img src="../layout/images/toursell6.png" alt="azora-dashboard" />
        </div>
           <p>1-	قم بالضغط على زر اضافة منتج</p>




        </div>


              </div>
                    <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <h1>لوحة المتابعة</h1>
                        <div class="tab-details">
                            <p style="font-weight:bold;">  من خلال هذه الشاشة ستتمكن من إستعراض أهم العمليات الخاصة بالبيع والشراء واستعراض المصروفات وتتبع المخزون عبر أشكال بيانيه بسيطة تمكنك من الحصول على تصور شامل حول حركة العمليات التجارية التي تمت في متجرك. </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/dashboard.png" alt="azora-dashboard" />
                            </div>
                        
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-pos" role="tabpanel"
                        aria-labelledby="v-pills-pos-tab">
                        <h1>نقطة البيع</h1>
                        <div class="tab-details">
                            <p style="font-weight:bold;">وتعتبر من أهم الواجهات في النظام إذ يتم من خلالها إجراء عملية بيع المنتج/ الخدمة للمستهلك: </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/pos/screenshots-06.png" alt="azora-dashboard" />
                            </div>
                            <p >1- أيقونة (كل المنتجات): تحتوي كافة المنتجات في المخزون وتعرضها بالكامل للمستخدم.  </p>
                            <p >2- أيقونة صنف المنتج: يتم من خلالها تصنيف المنتجات إلى أصناف رئيسية تتفرع إلى أصناف فرعية على سبيل المثال: الصنف الرئيسي مشروبات والأصناف الفرعية: ( عصير،ماء،حليب،مشروبات غازية...إلخ)  </p>
                            <p> 3- مربع خدمة الدفع: يتم عبره تحديد المنتج/منتجات المراد بيعها والكمية والسعر والمبلغ الإجمالي أو الكلي المطلوب دفعه من الزبون ويمكن عبره عمل خصم نقداً أو بنسبة مئوية معينة للزبون. </p>
                            <p> 4-  زر ( دفع ): عند ضغطه يتيح وسيلتين للدفع إما نقداً أو على الحساب  </p>
                           
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/pos/screenshots-07.png" alt="azora-dashboard" />
                            </div>
                            <p> 5- الدفع على الحساب: عبر الضغط على الزر سيتم نقلك لشاشة توضح الاتي: </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/pos/screenshots-08.png" alt="azora-dashboard" />
                            </div>                           
                            <p> 7- المستحق: قيمة المشتريات الذي قام العميل بطلبها العميل  </p>
                            <p> 8- المحصل: هو المبلغ الذي قام العميل بدفعه من قيمة مشترياتة  </p>
                            <p> 9- الباقي: يوضح المبلغ المتبقي للعميل في حال دفع أكثر من قيمة مشترياته </p>
                            <p> 10- الوسيلة: توضح وسيلة الدفع نقداً أو على الحساب  </p>
                            <p> 11- البيع وطباعة الفاتورة: بعد الإنتهاء من عملية البيع يتم طباعة الفاتورة.  </p>
                            <p> 12- زر دفع: يتم إختيارة عندما يقوم الزبون بالدفع نقداً. </p>
                            <p> 13- زر إلغاء: عند الضغط عليه تلغى عملية البيع   </p>
                            <p> 14- اختيار العميل: يتم من خلاله إدراج إسم العميل وبياناته أو يمكن إختيار من قائمة أسماء العملاء المسجلة مسبقاً </p>

                        
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-category" role="tabpanel"
                        aria-labelledby="v-pills-category-tab">
                        <h1>الاصناف</h1>
                         <div class="tab-details">
                         <p style="font-weight:bold;">  تحتوي هذه الشاشة على جميع أصناف المنتجات حيث تم تقسيمها إلى أصناف رئيسية تنقسم إلى أصناف فرعية  كالأتي: </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/cat/screenshots-18.png" alt="azora-dashboard" />
                            </div>
                            <p>1- حقل (البحث): ويتم إستخدامه للبحث عن صنف معين حسب رغبة المستخدم والتي تكون مضافة مسبقاً من قِبل المستخدم. </p>
                            <p>2- إسم الصنف: يحتوي على قائمة كاملة بأسماء جميع الأصناف الرئيسية. </p>
                            <p>3- زر (إضافة صنف): يتم إستخدامه لإضافة صنف ضمن قائمة الأصناف الرئيسية غير متواجد ضمن قائمة الأصناف الرئيسية الحالية و إضافة وصف له. </p>
                            <p>4- زر تحديد وتفعيل إسم الصنف (الرئيسي) : يتم الضغط لتفعيل زر (اسم الصنف) المراد اختياره لإجراء عملية البيع للصنف ويمكن للمستخدم عبرها الغاء او تفعيل تواجد الصنف في قائمة الأصناف المتوفرة للبيع.  </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/cat/screenshots-21.png" alt="azora-dashboard" />
                            </div>  
                            <p style="font-weight:bold;"> تبويب الأصناف الفرعية: يحتوي على عرض لجميع الأصناف الفرعية وقد تم وضع كل صنف فرعي تحت الصنف الرئيسي الذي يندرج ضمنه و يحتوي على التالي:</p>
                            <p>1- زر (إضافة صنف فرعي): ويتم من خلاله إضافة صنف فرعي جديد لقائمة الأصناف الفرعية المتواجدة للبيع و إدراجة تحت أحد الأصناف الرئيسية المحددة مسبقاً مع أمكانية إضافة وصف له على سبيل المثال: ( الصنف الفرعي (عصير) متفرع من الصنف الرئيسي (مشروبات)). </p>
                            <p>2- زر (أختر الصنف): عند الضغط عليه ستظهر قائمه بجميع الأصناف الرئيسية الموجودة والمسجلة مسبقاً قم باختيار الصنف الرئيسي الذي يندرج تحته الصنف الفرعي الذي قمت بإضافته لإدراجه تحت أحد الأصناف الرئيسية.</p>
                            <p>3- زر (الوصف): يتم من خلاله وضع وصف للمنتج الفرعي الذي تم إضافته من حيث (الإسم – السعة - المواصفات ....الخ ) </p>
                            <p>4- زر (إلغاء): يمكن من خلالها إلغاء كافة العمليات المدخلة سابقا في ذات الشاشة والخروج منها  </p>
                            <p>5- ايقونة (حفظ): ويتم عبر الضغط عليها حفظ كافة البيانات المدخلة في الشاشة وادراجها تلقائياً ضمن قائمة الأصناف الفرعية  </p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-product" role="tabpanel"
                        aria-labelledby="v-pills-product-tab">
                        <h1>المنتجات</h1>
                            <div class="tab-details">
                                <p style="font-weight:bold;">تحتوي هذه الشاشة على جدول يحتوي على المنتجات التي تم شراؤها من الموردين موضحة كالتالي:  </p>                            
                           <div class="tab-img">
                                <img src="../layout/images/manualImages/products/screenshots-13.png" alt="azora-dashboard" />
                            </div>
                          <p>زر (الثلاث النقاط الرأسية): يوجد جوار كل منتج يحتوي على خيارين كالتالي: </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060;">
                            <li>1- تحرير: يمكن للمستخدم تعديل بيانات المنتج المدخلة. </li>
                            <li>2- تحديث السعر: يتم من خلاله إدخال سعر جديد للمنتج.</li>
                            </ul>
                        
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel"
                        aria-labelledby="v-pills-purchase-tab">
                        <h1>المشتريات</h1>
                            <div class="tab-details">
                          <p style="font-weight:bold;"> ويقصد بها جميع عمليات الشراء التي قام بها التاجر من خلال الموردين. </p> 
                           <div class="tab-img">
                                <img src="../layout/images/manualImages/purchases/screenshots-27.png" alt="azora-dashboard" />
                            </div>
                            <p>1- واجهة عرض المشتريات: تحتوي على جدول يشمل جميع عمليات الشراء موضحة كالتالي: (رقم طلب الشراء، التاريخ، الإجمالي، حاله طلب الشراء، المورد ، المستخدم) موضحة بالتفصيل. </p>
                            <p>2- زر (الثلاث النقاط الرأسية) : يحتوي على ثلاث إختيارات كالتالي:  </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em;">
                            <li>1- عرض التفاصيل: يمكنك من خلاله إستعراض كافة تفاصيل عملية الشراء من المورد. </li>
                            <li>2- مرتجع: يحتوي على المنتج المراد إرجاعه مع تحديد الكمية المرغوب في إرجاعها ويظهر من خلاله المبلغ المرتجع للتاجر من المورد. </li>
                            <li>3- أرشفة: عند اختيارها يتم أرشفة عملية الشراء المحددة ولايمكن التراجع عنها. </li>
                            </ul>
                            <p>3- حقل جميع عمليات الشراء: يوضح أنواع عمليات الشراء كالآتي: </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em">
                            <li>1- جميع عمليات الشراء: بالضغط عليه يمكنك استعراض جميع عمليات الشراء التي تمت من الموردين  </li>
                            <li>2- عمليات الشراء المفتوحة: بالضغط عليه يمكنك إستعراض عمليات الشراء التي تم إنشاؤها ولكن لم ترسل للمورد بعد. </li>
                            <li>3-  عمليات الشراء المرسلة: بالضغط عليه يمكنك استعراض عمليات الشراء التي تم إرسالها لكن لم يتم إستلامها بعد (البضاعة) </li>
                            <li>4- عمليات الشراء الملغية: بالضغط عليه يمكنك استعراض عمليات الشراء التي تم إلغاؤها </li>
                            <li>5- عمليات الشراء المستلمة: بالضغط عليه يمكنك استعراض عمليات الشراء التي تم إستلامها </li>
                            <li>6- عمليات الشراء المؤرشفة: بالضغط عليه يمكنك استعراض عمليات الشراء التي تم أرشفتها </li>
                            </ul>
                            <p>4- زر (إضافة طلب شراء) ينقلك فورا لشاشة (عملية شراء جديدة) تمكنك الشاشة من إختيار المخزون المطلوب وإضافة مورد جديد أو إختيار مورد متواجد مسبقاً. </p>
                             <div class="tab-img">
                                <img src="../layout/images/manualImages/purchases/screenshots-28.png" alt="azora-dashboard" />
                            </div>
                            <p>4- مستطيل (البحث عن المنتجات): يمكنك البحث عن المنتج المراد شراؤة من المورد عبر كتابة أسمه في المستطيل وسيظهر إذا كان المنتج/المنتجات موجودة مسبقاً في المخزن (يمكنك إختيار أكثر من منتج في ذات الوقت) بعد إختيار المنتج/المنتجات يمكنك تسجيل سعر الشراء، وحدة القياس، تاريخ الإنتهاء، الكمية المستملة/ تكلفة الوحدة/ سعر البيع/ الإجمالي لكل منتج.  </p>
                            <p>5- زر إضافة منتج: يمكنك إضافة منتج جديد من الأسفل بالضغط على زر (إضافة منتج) وتعبئة بياناته كما هو موضح: ( إسم المنتج، الباركود، الصنف، الصنف الفرعي، الكمية، السعر، الضريبة، الوصف). </p>
                        </div>
                    </div>


                    <div class="tab-pane fade " id="v-pills-sales" role="tabpanel" aria-labelledby="v-pills-sales-tab">
                        <h1>المبيعات</h1>
                        <div class="tab-details">
                            <p style="font-weight:bold;">هي الواجهة التي يتم من خلالها عرض جميع عمليات البيع التي قام بها المستخدمون.  </p>               
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/sales/screenshots-25.png" alt="azora-dashboard" />
                            </div>
                            <p>1- توضح المنتجات / تاريخ البيع / فاتورة البيع ورقمها / المبلغ المدفوع / سعر المنتج / المستخدم / إسم الزبون /نسبة الخصم / الضريبة المضافة للمنتج/ حالة الدفع (كلي، جزئي) / إسم المتجر ورقمه وعنوانه. </p>
                            <p>2- إنشاء مبيعات جديدة: ويتم من خلالها الانتقال لشاشة (نقاط البيع) التي تحتوي على جميع المنتجات والخدمات ويتم من خلالها إصدار فاتورة بيع للزبون. </p>
                            <p style="font-weight:italic; color:#64B6FF; padding:1em 0em">إذا أردت معرفة كمية المبيعات يتم الرجوع لشاشة (التقارير مبيعات) </p>
                          <p>3- زر (الثلاث النقاط الرأسية): يوجد جوار كل منتج يحتوي على خيارين كالتالي: </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060;">
                              <li>1- زر عرض التفاصيل: ويتم من خلاله إستعراض كافة تفاصيل بيع المنتج (الكمية، السعر، الخصم، الإجمالي، رقم الفاتورة، الحالة (مدفوع – على الحساب) </li>
                              <li>2- زر المرتجع: بالضغط عليه يتم نقلك لشاشة المرتجع ويمكنك من خلاله إجراء عملية الإرجاع بإختيار المنتج المحدد وإجراء العملية. </li>
                            </ul>
                        
                        </div>
                    </div>
                    <div class="tab-pane fade " id="v-pills-inventory" role="tabpanel"
                        aria-labelledby="v-pills-inventory-tab">
                        <h1>المخزون</h1>
                        <div class="tab-details">
                           <p style="font-weight:bold;">توضح هذه الشاشة عدد المخازن التي يمتلكها التاجر ويتم من خلالها إضافة مخزن جديد و إستعراض المنتجات والأصناف الفرعية والرئيسية المتواجدة فيه /الكمية /إجمالي السعر/ تاريخ الإنتهاء/ خيار لحالة توفر المنتج: تفعيل أو عدم تفعيل ليضاف لقائمة المنتجات المتوفرة في المخزن أو التي نفدت من المخزون.</p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/inventory/screenshots-37.png" alt="azora-dashboard" />
                            </div>
                               <p>1- أيقونة الرئيسي: يمكنك عند الضغط عليها إستعراض كمية المنتجات والاصناف المتواجدة في المخزون الأول (الرئيسي) </p>
                               <p>2- أيقونة إضافة مساحة جديدة: يتم عبرها إنشاء مخزن جديد.  </p>
                               <p>3-  زر الثلاث النقاط الرأسية: متواجد جوار حاله التفعيل عند الضغط عليه يظهر لك خيارين لعرض المنتجات كالتالي: </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060;">
                               <li>1- عرض التالفة ومنتهية الصلاحية  </li>
                               <li>2-  إظهار الكل</li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-expenses" role="tabpanel"
                        aria-labelledby="v-pills-expenses-tab">
                        <h1>المصروفات</h1>
                        <div class="tab-details">
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/expenses/screenshots-33.png" alt="azora-dashboard" />
                            </div>
                        <p>1- زر تحديد (نوع المصروفات): ويتم من خلاله عرض أنواع المصروفات الأساسية (أيجار-مواصلات- كهرباء- ماء- مرتبات...الخ) </p>
                        <p>2- مستطيل البحث: يُستخدم للبحث عن أي من المصروفات التي تم تسجيلها مسبقاً. </p>
                        <p>3- الجدول التفصيلي: يتم من خلاله عرض جميع تفاصيل المصروفات كالتالي: (التاريخ، النوع، البيان والمبلغ المستحق) </p>
                        <p>4- الثلاث نقاط الرأسية: جوار كل سطر في الجدول التفصيلي يتم من خلال النقر عليها: </p>
                        <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em">
                        <li>1- تحرير: لتعديل البيانات المدخلة سابقاً للمصروفات </li>
                        <li>2- عرض تفاصيل: توضح بيان تفصيلي للمصروفات </li>
                        </ul>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/expenses/screenshots-32.png" alt="azora-dashboard" />
                            </div>
                        <p  style="font-weight:bold;"> زر إضافة: يتم استخدامه لإضافة (نوع مصروف) جديد أو إدراجه ضمن أحد أنواع المصروفات الأساسية الموجودة مسبقاً وتحتوي الشاشة على الأتي:  </p>
                        <p>5- زر النوع: يحتوي على جميع أنواع المصروفات المضافة مسبقاً ويتم إستخدامه لتحديد نوع المصروف قبل إضافة بقية البيانات .   </p>
                        <p>6- الإجمالي: يتم إدخال المبلغ المدفوع لنوع المصروف الذي تم إختياره. </p>
                        <p>7- البيان: يتم إضافة وصف للخدمه التي تم دفع المصروف لسدادها على سبيل المثال: (مرتب البائع لشهر مارس) ضمن النوع (مرتبات وأجور).  </p>
                        <p>8- التاريخ: يتم من خلاله تحديد اليوم والتاريخ الذي تم فيه دفع المصروفات. </p>



                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-report" role="tabpanel"
                        aria-labelledby="v-pills-report-tab">
                        <h1>التقارير</h1>
                        <div class="tab-details">
                           <p style="font-weight:bold;"> تمكنك هذه الشاشة من إستعراض جميع التقارير الخاصة بجميع العناصر في قائمة آزورا الرئيسية كالتالي:</p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/reports/reports.png" alt="azora-dashboard" />
                            </div>
                          <p>( المنتجات / المشتريات / المبيعات / المخزون/ الأصناف / الأصناف الفرعية / الأرباح / المورد/ الزبون/ النقدية ) 
                          عبر هذه الشاشة يتم إنشاء تقارير مفصله/ موجزة عن نشاط المتجر بشكل متكامل بالتفصيل لما يريد إستعراضه أو معرفته عن أي عنصر في قائمه آزورا الرئيسية.  </p>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-customer" role="tabpanel"
                        aria-labelledby="v-pills-customer-tab">
                        <h1>الزبائن</h1>
                         <div class="tab-details">
                            <p style="font-weight:bold;">تحتوي واجهة الزبائن على قائمة كاملة بجميع زبائن المتجر ومعلوماتهم الأساسية تحوي مشترياتهم بالتفصيل من المتجر والمدفوعات والديون والسداد لكل عميل على حدة وتعمل الشاشة كالتالي :</p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/customers/screenshots-83.png" alt="azora-dashboard" />
                            </div>
                            <p>1- إختيار العملاء: يتم إختيار العميل المنشود من الجدول بالضغط على أسمه لإستعراض بياناته ومشترياته وديونه. </p>
                            <p>2- زر الثلاث النقاط جوار كل عميل يحوي خيارين:  </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em">
                            <li>1- عرض التفاصيل: يحتوي على معلومات الزبون الأساسية والحساب والدين والمبلغ المسدد والمتبقي مع خيار لعرض فاتورة الشراء بالتفصيل  </li>
                            <li>2- تحرير: يمكن من خلالها تعديل بيانات الزبون الأساسية  </li>
                            </ul>
                            <p>3- زر إضافة زبون: يمكن من خلاله إضافة زبون جديد وإدراج بياناته الأساسية كالتالي: (الإسم ، اللقب، رقم الهاتف، الرصيد الإفتتاحي ، البريد الإلكتورني، العنوان)  </p>
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/customers/Screenshot_20210526-124235.png" alt="azora-dashboard" />
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-supplier" role="tabpanel"
                        aria-labelledby="v-pills-supplier-tab">
                        <h1>الموردين</h1>
                        <div class="tab-details">
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/suppliers/screenshots-43.png" alt="azora-dashboard" />
                            </div>
                            <p>
                            1- من قائمة الأشخاص قم باختيار(الموردين) وقم بإضافة مورد.  
                            </p>
                            <p>2- يمكنك البحث عن إسم أي مورد  من خلال كتابة أسمه أو لقبه أعلى الشاشة في مربع البحث. </p>
                            <p>3- عند إختيار المورد والضغظ على اسمة سوف تنتقل إلى واجهة يوجد بها عرض لكافة معلومات المورد وتفاصيل التعاملات (المشتريات، الديون تاريخ الشراء والسداد ). </p>

                            <p>4- جوار رقم الهاتف يوجد زر (ثلاث نقاط رأسية) يمكنك من خلاله عرض وتعديل أو حذف بيانات المورد و عرض كافة تفاصيل التعاملات والديون والسداد وتاريخ الشراء والدفع. </p>

                            <p>5- قم بإضافة بيانات المورد كالتالي: الاسم /اللقب /رقم الهاتف /إسم الشركة / البريد الالكتروني /العنوان. </p>


                            <div class="tab-img">
                                <img src="../layout/images/manualImages/suppliers/screenshots-44.png" alt="azora-dashboard" />
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                        <h1>المستخدمين</h1>
                         <div class="tab-details">
                            <div class="tab-img">
                                <img src="../layout/images/manualImages/user/screenshots-85.png" alt="azora-dashboard" />
                            </div>
                            <p>1- هي الشاشة الخاصة بإضافة إسم الشخص المسؤول عن البيع للعملاء بإستخدام نظام آزورا وتستعرض عدد المستخدمين و أسمإهم وبياناتهم.</p>

                            <div class="tab-img">
                                <img src="../layout/images/manualImages/user/screenshots-86.png" alt="azora-dashboard" />
                            </div>
                            <p>2- يتم إضافة إسم المستخدم وبياناته  من خلال الدخول من واجهة المستخدمين وضغط زر إضافة مستخدم وإدراج اسم المستخدم وبياناته في هذه الشاشة: ( الإسم، رقم الهاتف، البريد الإلكتروني، كلمة السر ). </p>
                            <p>3- أضغظ زر حفظ بعد الإنتهاء من إضافة بيانات المستخدم. </p>
                        </div>
                    </div>

                    <div class="tab-pane fade " id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">
                        <h1>الاعدادات</h1>
                            <div class="tab-details">
                            <p style="font-weight:bold;">تحتوي هذه الشاشة على الإعدادات العامة والخاصة كالتالي: </p>

                            <div class="tab-img">
                                <img src="../layout/images/manualImages/settings/screenshots-57.png" alt="azora-dashboard" />
                            </div>
                            <p>1- إعدادات عامة تتضمن: </p>
                            <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em">
                            <li>1- الصورة الخاصة بالمحل </li>
                            <li>2- اسم المتجر / البريد الإلكتروني / الهاتف / العنوان   </li>
                            <li>3- الاعدادات الخاصة باللغة : يمكن للمستخدم إختيار اللغة بما يناسبه ( عربي – إنجليزي ) </li>
                            </ul>

                           <p>إعدادات خاصة بالمنتج وتشمل: </p>

                            <div class="tab-img">
                                <img src="../layout/images/manualImages/settings/screenshots-58.png" alt="azora-dashboard" />
                            </div>
                             <p>1- الخصم: يُستخدم لتحديد نسبة الخصم للمنتجات بنسبة مئوية يحددها البائع حيث يمكنه أن يضع أكثر من نسبة يقوم بإختيار أي منها عند البيع ويمكن الرجوع إلى شاشة نقاط البيع لتخصيص خصم لمنتج معين نقداً أو بنسبة مئوية محددة مسبقاً. </p>
                             <p>2- الضريبة: لإضافه ضريبة على المنتجات اختر زر إضافه ضريبة وقم بتحديد النسبة المئوية المراد إضافتها كضريبة للمنتج، يمكن الرجوع إلى (شاشة المنتجات /إضافة منتج) لتخصيص ضريبة لمنتج معين. </p>
                             <p>3- اعدادات البيع والشراء: يتم من خلالها التحكم في تفعيل إجراءات وخطوات البيع والشراء من عدمه حسب رغبة صاحب المتجر. </p>
                             <ul style="font-weight:bold; padding-right:2em; color: #616060; padding-bottom:1em">
                             <li>1- إضافة المنتجات مباشرة إلى المخزون: تُشير إلى أن البضاعة تم إستلامها عند تفعيله أو عند عدم إستلامها أن عمليه الشراء مفتوحة (راجع شاشة المشتريات) </li>
                             <li>2- إخفاء زر البيع بدون فاتوره: في حال الرغبة في إصدار فاتوره لكل عملية بيع وإخفاء خيار البيع بدون فاتوره. </li>
                             <li>3- طباعه فاتورتين: يتوفر هذا الخيار لأصحاب المقاهي أو المطاعم...إلخ. </li>
                             <li>4- تفعيل الدفع السريع: يُستخدم لتسريع عملية البيع وإضافة جميع الايقونات الخاصة بالدفع في مكان واحد. </li>
                             <li>5- إشعار إنتهاء صلاحية المنتج: لتنبيه البائع إلى قرب إنتهاء صلاحيه المنتجات في خانة تنبيهات النظام. </li>                             
                             </ul>

                             <p>4- وحدات العد ويمكنك من خلالها اضافة وحده العد التي تريدها مثل الكيلو او الجرام او الحبه او الكرتون</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="manual-mobile">

        <div class="manual-nav-wrapper-mobile">
            <div class="container">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-tour-tab" data-toggle="pill" href="#v-pills-tour"
                        role="tab" aria-controls="v-pills-tour" aria-selected="true">جولة بالنظام</a>

                    <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">لوحة المتابعة</a>

                    <a class="nav-link " id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category"
                        role="tab" aria-controls="v-pills-category" aria-selected="true">الاصناف</a>

                    <a class="nav-link " id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product" role="tab"
                        aria-controls="v-pills-product" aria-selected="true">المنتجات</a>

                    <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase" role="tab"
                        aria-controls="v-pills-purchase" aria-selected="false">المشتريات</a>

                    <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab"
                        aria-controls="v-pills-sales" aria-selected="false">المبيعات</a>

                    <a class="nav-link" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory"
                        role="tab" aria-controls="v-pills-inventory" aria-selected="false">المخزون</a>

                    <a class="nav-link" id="v-pills-expenses-tab" data-toggle="pill" href="#v-pills-expenses" role="tab"
                        aria-controls="v-pills-expenses" aria-selected="false">المصروفات</a>

                    <a class="nav-link" id="v-pills-report-tab" data-toggle="pill" href="#v-pills-report" role="tab"
                        aria-controls="v-pills-report" aria-selected="false">التقارير</a>

                    <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab"
                        aria-controls="v-pills-customer" aria-selected="false">الزبائن</a>

                    <a class="nav-link" id="v-pills-supplier-tab" data-toggle="pill" href="#v-pills-supplier" role="tab"
                        aria-controls="v-pills-supplier" aria-selected="false">الموردين</a>

                    <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab"
                        aria-controls="v-pills-user" aria-selected="false">المستخدمين</a>

                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">الاعدادات</a>
                </div>
            </div>
        </div> 
        ';
    }

    else{
        echo '
        <div class="row">
        <div class="col-md-3">
            <div class="nav-wrapper">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-tour"
                        role="tab" aria-controls="v-pills-home" aria-selected="true">Getting Started</a>

                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                        role="tab" aria-controls="v-pills-home" aria-selected="true">Dashboard</a>

                    <a class="nav-link " id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category"
                        role="tab" aria-controls="v-pills-category" aria-selected="true">Category</a>

                    <a class="nav-link " id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product"
                        role="tab" aria-controls="v-pills-product" aria-selected="true">Product</a>

                    <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase"
                        role="tab" aria-controls="v-pills-purchase" aria-selected="false">Purchase</a>

                    <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab"
                        aria-controls="v-pills-sales" aria-selected="false">Sales</a>

                    <a class="nav-link" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory"
                        role="tab" aria-controls="v-pills-inventory" aria-selected="false">Inventory</a>

                    <a class="nav-link" id="v-pills-expenses-tab" data-toggle="pill" href="#v-pills-expenses"
                        role="tab" aria-controls="v-pills-expenses" aria-selected="false">Expesnes</a>

                    <a class="nav-link" id="v-pills-report-tab" data-toggle="pill" href="#v-pills-report" role="tab"
                        aria-controls="v-pills-report" aria-selected="false">Reports</a>

                    <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer"
                        role="tab" aria-controls="v-pills-customer" aria-selected="false">Customer</a>

                    <a class="nav-link" id="v-pills-supplier-tab" data-toggle="pill" href="#v-pills-supplier"
                        role="tab" aria-controls="v-pills-supplier" aria-selected="false">Supplier</a>

                    <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab"
                        aria-controls="v-pills-user" aria-selected="false">Users</a>

                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                        role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                
            <div class="tab-pane fade show active" id="v-pills-tour" role="tabpanel" aria-labelledby="v-pills-tour-tab">
                  <h2>Tour</h2>
                </div>

                <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <h2>Dashboard</h2>
                    <div class="tab-details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab nihil eius dicta quo
                            doloribus ipsum fugit aperiam et distinctio non.</p>
                        <div class="tab-img">
                            <img src="../layout/images/dashboard.png" alt="azora-dashboard" />
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ducimus rem nisi omnis
                            reiciendis laboriosam inventore quod. Velit odio vitae quasi tempore soluta eaque
                            assumenda, corrupti ea, repellendus cum culpa esse cupiditate incidunt doloribus ratione
                            eos. Esse unde dignissimos suscipit.</p>

                        <div class="tab-img">
                            <img src="../layout/images/dashboard.png" alt="azora-dashboard" />
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-category" role="tabpanel"
                    aria-labelledby="v-pills-category-tab">
                    <h2>Category</h2>
                </div>

                <div class="tab-pane fade" id="v-pills-product" role="tabpanel"
                    aria-labelledby="v-pills-product-tab">
                    <h2>Product</h2>
                </div>

                <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel"
                    aria-labelledby="v-pills-purchase-tab">
                    <h2>Purchase</h2>
                </div>


                <div class="tab-pane fade " id="v-pills-sales" role="tabpanel" aria-labelledby="v-pills-sales-tab">
                    <h2>Sales</h2>
                </div>
                <div class="tab-pane fade " id="v-pills-inventory" role="tabpanel"
                    aria-labelledby="v-pills-inventory-tab">
                    <h2>Inventory</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-expenses" role="tabpanel"
                    aria-labelledby="v-pills-expenses-tab">
                    <h2>Expenses</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-report" role="tabpanel"
                    aria-labelledby="v-pills-report-tab">
                    <h2>Reports</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-customer" role="tabpanel"
                    aria-labelledby="v-pills-customer-tab">
                    <h2>Customer</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-supplier" role="tabpanel"
                    aria-labelledby="v-pills-supplier-tab">
                    <h2>Supplier</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                    <h2>User</h2>
                </div>

                <div class="tab-pane fade " id="v-pills-settings" role="tabpanel"
                    aria-labelledby="v-pills-settings-tab">
                    <h2>Settings</h2>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="manual-mobile">

    <div class="manual-nav-wrapper-mobile">
        <div class="container">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-tour-tab" data-toggle="pill" href="#v-pills-tour"
                    role="tab" aria-controls="v-pills-tour" aria-selected="true">Quick Tour</a>

                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">Dashboard</a>

                <a class="nav-link " id="v-pills-category-tab" data-toggle="pill" href="#v-pills-category"
                    role="tab" aria-controls="v-pills-category" aria-selected="true">Category</a>

                <a class="nav-link " id="v-pills-product-tab" data-toggle="pill" href="#v-pills-product" role="tab"
                    aria-controls="v-pills-product" aria-selected="true">Product</a>

                <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase" role="tab"
                    aria-controls="v-pills-purchase" aria-selected="false">Purchase</a>

                <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab"
                    aria-controls="v-pills-sales" aria-selected="false">Sales</a>

                <a class="nav-link" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory"
                    role="tab" aria-controls="v-pills-inventory" aria-selected="false">Inventory</a>

                <a class="nav-link" id="v-pills-expenses-tab" data-toggle="pill" href="#v-pills-expenses" role="tab"
                    aria-controls="v-pills-expenses" aria-selected="false">Expesnes</a>

                <a class="nav-link" id="v-pills-report-tab" data-toggle="pill" href="#v-pills-report" role="tab"
                    aria-controls="v-pills-report" aria-selected="false">Reports</a>

                <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab"
                    aria-controls="v-pills-customer" aria-selected="false">Customer</a>

                <a class="nav-link" id="v-pills-supplier-tab" data-toggle="pill" href="#v-pills-supplier" role="tab"
                    aria-controls="v-pills-supplier" aria-selected="false">Supplier</a>

                <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab"
                    aria-controls="v-pills-user" aria-selected="false">Users</a>

                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                    aria-controls="v-pills-settings" aria-selected="false">Settings</a>
            </div>
        </div>
    </div> 
        
        ';

    }
        ?>
        <button><i class="fa fa-book-open"></i></button>


    </div>
    <script>

    </script>
</section