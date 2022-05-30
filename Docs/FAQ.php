<?php
include("include/header.php");
?>
<section class="faq">
    <div class="container">
        <?php 
    if($_SESSION["language"] == "ar_EG"){
       echo '
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            كيف أسجل الدخول إلى حسابي؟ <i class="fa" aria-hidden="true"></i>

                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>
                        من خلال مكتب آزورا.
                        </p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            ما هي الميزات التي أبحث عنها؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            <li>• وضع عدم الاتصال بالإنترنت : تسجيل المبيعات و معالجة مدفوعات بطاقات الائتمان دون اتصال بالإنترنت.</li>
                            <li>• حسابات المستخدمين: حسابات غير محدودة للمستخدمين</li>
                            <li>• قائمة المنتجات: إضافة السلع للطلبات و تتبع السلع لكل عملية بيع</li>
                            <li>• إدارة المخزون: إستخدام أدوات تتبع المخزون المدمجة في آزورا و المزامنة في التخزين السحابي</li>
                            <li>• طلبات الشراء : التنبؤ بطلبات الشراء وتتبعها و متابعة عمليات نقل البضائع الخاصة بالمتجر</li>
                            <li>• إدارة مواقع المتعددة: تتبع المبيعات والمخزون عبر مواقع متعددة</li>
                            <li>• تتبع وإدارة مبيعات الموظفين: إدارة الوصول وتتبع المبيعات من خلال  الموظف</li>
                            <li>• إدارة ديون العملاء : إرسال رسائل نصية  قصيرة ورسائل واتس أب مباشرة من نقاط بيع آزورا إلى هواتف العملاء لعرض فواتيرهم بشكل دوري.</li>
                            <li>• أجهزة أندرويد :  يمكنك إستعراض نشاط متجرك من أي جهاز يعمل بنظام  أندرويد ، ويعمل تطبيقنا على أي هاتف محمول أو كمبيوتر محمول أو جهاز مكتبي يحتوي على متصفح.</li>
                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            كيف يتم إدارة المخزون؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThree" class="collapse " aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            <li>• تزويد العميل بنظرة شاملة على مستويات المخزون في كل موقع.</li>
                            <li>• إنشاء تقارير عن المنتجات والعلامات التجارية الأكثر مبيعًا.</li>
                            <li>• إصدار تنبيهات آلية عند نفاد المخزون أو قرب إنتهاء الصلاحية. </li>
                            <li>• ضمان سير العمل بإنسيابية أثناء القيام بطلبات الشراء.</li>
                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                            هل يقوم النظام برفع ومزامنة معلومات المتجر إلى الموقع؟ <i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFour" class="collapse " aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            <li>• تتم مزامنة المخزون والمبيعات و معلومات العملاء وطلبات الشراء بين المتجر و الموقع. </li>
                            <li>• يمتاز النظام بلوحة تحكم مصممة بشكل احترافي وسهلة الاستخدام ولا يتطلب العمل عليها أي مهارات فنية. </li>
                            <li>• تم تصميم موقع إلكتروني يمكن لعملائنا من خلالة متابعة نشاطهم التجاري و يمكن تصفحة من خلال الهاتف النقال أو التابلت أو الكمبيوتر من خلال إي متصفح.</li>

                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                            هل يوفر النظام تحليل مفصل لنشاط متجرك و تقارير يعتمد عليها؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFive" class="collapse " aria-labelledby="headingFive" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>لا يقتصر عمل النظام على متابعة نشاط متجرك فحسب ، بل يساعدك على التواصل بشكل أكثر فعالية مع عملائك و إغتنام الفرص لتنمية تجارتك.</p>
                        <ul>
                            <li>• إعطاء تقارير عن المنتجات الأكثر ربحاً ، والمنتجات الأكثر مبيعًا ، والمنتجات الأقل مبيعًا ، وساعات العمل في المتجر ، وأفضل العلامات التجارية. </li>
                            <li>• إنشاء تقارير تظهر سجل مشتريات العميل وأداء الموظف.</li>

                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                            هل توفر الشركة التدريب على إستخدام النظام والدعم؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordionExample">
                    <div class="card-body">
                        <p> تعد جلسة الإعداد لإستخدام النظام مع المختص أمرًا أساسيًا للبدء وسيساعدك توفر الوصول المستمر إلى الدعم الفني في حل أي مشكلات قد تواجهها.</p>
                        <ul>
                            <li>• فريق الدعم الفني لدينا سيقوم بتثبيت النظام و تقديم الخدمات و الاستشارة واستكشاف الأخطاء وإصلاحها في الموقع. </li>
                            <li>•  توفير مجموعة متنوعة من المواد التدريبية ، بما في ذلك مركز المساعدة والمنتديات المجتمعية و الموارد المتاحة على الإنترنت.</li>
                            <li>•  نشر تقييمات لنسبة رضا العملاء عن النظام.</li>

                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                            هل النظام قائم على النظام السحابي؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseSeven" class="collapse " aria-labelledby="headingSeven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• يتيح لك النظام القائم على السحابة الوصول إلى بيانات متجرك والتقارير الخاصة بك من أي مكان تكون فيه. كما أنه قابل للتوسع ويوفر تكاليف أقل بشكل ملحوظ.</p>
                        <ul>
                            <li>• القدرة على الوصول إلى بيانات متجرك  والإطلاع عليها من أي جهاز أندرويد ، إينما كنت.</li>
                            <li>• النسخ الاحتياطي للبيانات يتم آليا و يقوم برفعها إلى السحابة.</li>


                        </ul>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                            هل يمكن أن يعمل آزورا سوفت  دون اتصال بالإنترنت؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseEight" class="collapse " aria-labelledby="headingEight"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم ، حيث لا يتطلب نظام آزورا الاتصال بشبكة الإنترنت للعمل علية ، فقط عند رفع بيانات المتجر للحفظ في السحابة.</p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                            كيف يمكنني الإطلاع على سجل المبيعات  الخاصة بالمتجر كاملة ؟ <i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseNine" class="collapse " aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <p> • افتح صفحة التقارير ثم افتح تقرير المبيعات وأضف من التاريخ من وإلى.</p>
                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingTen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                            كيف يمكنني الوصول إلى حساب آزورا الخاص بي من جهاز آخر؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTen" class="collapse " aria-labelledby="headingTen" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• من خلال الموقع الإلكتروني<a href="https://www.azora.tech/azora/login.php">www.azora.tech/login</a>
                        </p>
                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingEleven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                            هل يمكن للعملاء سداد ديونهم من خلال حوالة بنكية؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseEleven" class="collapse " aria-labelledby="headingEleven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• حالياً ، نقوم بالتعامل مع بعض المحافظ الإلكترونية المتواجدة في اليمن لجعل ذلك ممكنًا على سبيل المثال: خدمة محفظتي بواسطة بنك التضامن.</p>
                    </div>
                </div>


            </div>




            <div class="card">
                <div class="card-header" id="headingTwelve">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                            كم من الوقت يستغرق إعداد نظام آزورا؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwelve" class="collapse " aria-labelledby="headingTwelve"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p> • يعتمد ذلك على كمية البيانات التي سوف يتم إدخالها في النظام.</p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
                            أنا لست شخص تقني ، هل سأجد صعوبة في إدراج منتجاتي وبيانات عملائي في نظام آزورا؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirteen" class="collapse " aria-labelledby="headingThirteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• لا ، سيهتم فريق الدعم الفني لدينا بعملية إدخال المنتجات و بيانات العملاء و يقوم بذلك نيابة عنك ، يمكن إعداد نظام آزورا للعمل في أقل وقت ممكن والنهوض بنشاط متجرك.</p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFourteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
                            لدي الآلاف من الباركود المطبوعة الجاهزة من نقاط البيع القديمة ، هل يمكنني استخدامها مع  نظام آزورا؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourteen" class="collapse " aria-labelledby="headingFourteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>نعم ، يمكنك ذلك. </p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFifteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFifteen" aria-expanded="true" aria-controls="collapseFifteen">
                            أنا مرتاح مع نظام نقاط البيع الذي أمتلكة ، هل نظام آزورا هو حقًا خيار أفضل؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFifteen" class="collapse " aria-labelledby="headingFifteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• معظم الأشخاص الذين حولوا إلى نظام آزورا لم يتراجعوا عن قرارهم أبداً. يفضل التجار واجهة النظام الخاصة بآزورا كونها سهلة الاستخدام و تعمل بديهيًا، بالإضافة إلى مميزات النظام و تكاملة. </p>

                        <p>• ومع ذلك ، نحن نتفهم أن كل نشاط تجاري فريد من نوعه ، وقد لا تكون جميع الأدوات مناسبة لك. لهذا السبب ندعوك لأخذ جولة في برنامجنا ومعرفة ما إذا كان يلبي إحتياجاتك.
                        </p>
                        <p>• أخيرًا ، يمكنك دائمًا التحدث إلى مهندسينا الموثوق بهم بشأن أي أسئلة أو مخاوف محددة وسوف يساعدونك في تحديد ما إذا كان نظام آزورا مناسبًا لك حقًا. راسلنا على <a href="mailto: info@azora.tech">info@azora.tech</a> أو اتصل على الرقم : 01573062.
                        </p>
                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingSixteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSixteen" aria-expanded="true" aria-controls="collapseSixteen">
                            أنا لا أعيش في اليمن ، هل يعمل نظام آزورا  في بلدي؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseSixteen" class="collapse " aria-labelledby="headingSixteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم ، فنظام آزورا غير مرتبط ببلد معين لأنه قائم على نظام السحابة.</p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingSeventeen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseSeventeen" aria-expanded="true" aria-controls="collapseSeventeen">
                            أخشى مواجهة المشاكل إذا كانت لدي أسئلة ، فهل يمكنني الاتصال بفريق الدعم في أي وقت؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseSeventeen" class="collapse " aria-labelledby="headingSeventeen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم ، فريقنا الفني متاح من الساعة 8:00 صباحًا إلى 11:00 مساءً.</p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingEighteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseEighteen" aria-expanded="true" aria-controls="collapseEighteen">
                            أمتلك عملاً موسميًا. هل يمكنني إلغاء اشتراكي مع الاحتفاظ ببياناتي؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseEighteen" class="collapse " aria-labelledby="headingEighteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم  يمكنك ذلك، نحتاج إلى اتصال بالإنترنت كل يومين إلى ثلاثة أيام فقط لمنح نظامك نسخة احتياطية مشفرة ورفع بيانات متجرك إلى السحابة الشخصية الخاصة بك.</p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingNineteen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseNineteen" aria-expanded="true" aria-controls="collapseNineteen">
                            لدي أكثر من متجر ، هل يمكن ل نظام آزورا تولي ذلك؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseNineteen" class="collapse " aria-labelledby="headingNineteen"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>•  نعم ، للحالات الخاصة المميزة.</p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingTwenty">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwenty" aria-expanded="true" aria-controls="collapseTwenty">
                            لا أشعر بالراحة تجاه الإنظمة المعتمدة على شبكة الإنترنت ، فهل بياناتي آمنة في السحابة؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwenty" class="collapse " aria-labelledby="headingTwenty"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم،يمكنك الإطمئان على أن بياناتك آمنة تماماً في السحابة حيث إنها ستكون مشفرة بالخوارزمية 128 AES 
                        
                        
                        </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentyone">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentyone" aria-expanded="true" aria-controls="collapseTwentyone">
                            أحتاج إلى شخص ليقوم بتثبيت وإعداد النظام للعمل. هل توفر شركة آزورا خدمة إجراء مكالمات منزلية؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentyone" class="collapse " aria-labelledby="headingTwentyone"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم، نوفر للعميل خدمة إعداد وتجهيز النظام للعمل حيث سيهتم فريقنا الفني بكل ذلك.</p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingTwentytwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentytwo" aria-expanded="true" aria-controls="collapseTwentytwo">
                            يروق لي نظام آزورا لكن لا أعرف من أين أبدأ ، ماذا أفعل بعد ذلك؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentytwo" class="collapse " aria-labelledby="headingTwentytwo"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• سجل دخول من خلال موقع آزورا الإلكتروني وسيقوم فريقنا بالاتصال بك في أسرع وقت ممكن.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentythree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentythree" aria-expanded="true" aria-controls="collapseTwentythree">
                            لماذا يجب علي استخدام برنامج لنقاط البيع؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentythree" class="collapse " aria-labelledby="headingTwentythree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نظام نقاط البيع عبارة عن باقة برمجية يتم إستخدامها غالباً مع مجموعة أجهزة متوافقة مصاحبة للنظام تستخدم لتنظيم أعمالك وتشغيلها. يربط النظام خدمة العملاء والمخزون والحسابات والأقسام الأخرى ضمن برنامج واحد ، مما يساعد على مركزية مهامك الإدارية. يعد استخدام نظام نقاط بيع موفرًا للوقت بشكل كبير وفعال مقارنةً بإستخدام نظام منفصل لإدارة كل منطقة.</p>
<p>يمكنه أيضًا تحسين تجربة العميل من خلال إدارة المبيعات بشكل فعال ، وتقليل الفاقد من خلال تسوية المخزون آليا و إعطاء تنبيهات للتاجر عند الحاجة لطلب بضاعة و قرب إنتهاء صلاحية المنتجات ، ومنع إي إختلاس.</p>
                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentyfour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentyfour" aria-expanded="true" aria-controls="collapseTwentyfour">
                            كم يكلف  نظام آزورا لنقاط البيع؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentyfour" class="collapse " aria-labelledby="headingTwentyfour"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• لدينا ثلاث باقات متاحة يمكنك التحقق منها على الرابط الخاص بنا (الرابط).
                        </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentyfive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentyfive" aria-expanded="true" aria-controls="collapseTwentyfive">
                            إذا توقف السيرفر عن العمل ، فهل سيكون الجهاز قادر على إتمام عملية البيع؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentyfive" class="collapse " aria-labelledby="headingTwentyfive"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم. نظرًا لأن نظامنا يعمل دون اتصال بالإنترنت ، فإن جميع وظائف النظام متاحة دون الحاجة للإتصال بالإنترنت .</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentySix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentySix" aria-expanded="true" aria-controls="collapseTwentySix">
                            هل يمكنني نقل بياناتي من نقطة البيع الحالية إلى نظام برمجي جديد لنقاط البيع؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentySix" class="collapse " aria-labelledby="headingTwentySix"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم، يمكنك ذلك بمجرد تجربة نظام آزورا لن تنظر إلى الوراء أبدًا.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentySeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentySeven" aria-expanded="true" aria-controls="collapseTwentySeven">
                            هل يمكنني تحليل بيانات العميل باستخدام نقاط البيع؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentySeven" class="collapse " aria-labelledby="headingTwentySeven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentyEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentyEight" aria-expanded="true" aria-controls="collapseTwentyEight">
                            هل يوجد حد لعدد المنتجات التي يمكنني الحصول عليها في الكتالوج الخاص بي؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentyEight" class="collapse " aria-labelledby="headingTwentyEight"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• لا. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingTwentyNine">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwentyNine" aria-expanded="true" aria-controls="collapseTwentyNine">
                            إذا كنت أرغب في تغيير مدى توفر منتج واحد / بعض المنتجات ، فكيف يمكنني القيام بذلك؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseTwentyNine" class="collapse " aria-labelledby="headingTwentyNine"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• ستفتح صفحة المنتج وتنتقل إلى المنتج الذي تريد إيقافه مؤقتًا وتقوم بإيقاف تشغيل زر الحالة. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirty">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirty" aria-expanded="true" aria-controls="collapseThirty">
                            هل يعمل التطبيق في كل دولة وبكل عملة؟<i
                                class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirty" class="collapse " aria-labelledby="headingThirty"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم. </p>

                    </div>
                </div>


            </div>


            <div class="card">
                <div class="card-header" id="headingThirtyone">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtyone" aria-expanded="true" aria-controls="collapseThirtyone">
                            هل يمكنني استخدام نظام آزورا إذا كان لدي العديد من منافذ البيع بالتجزئة؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtyone" class="collapse " aria-labelledby="headingThirtyone"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtytwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtytwo" aria-expanded="true" aria-controls="collapseThirtytwo">
                            هل يمكنني إستخدام نظام آزورا إذا كان لدي أكثر من موظف؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtytwo" class="collapse " aria-labelledby="headingThirtytwo"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>•    نعم ، لدينا نظام مُستخدم محلي. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtythree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtythree" aria-expanded="true" aria-controls="collapseThirtythree">
                            هل يمكنني إعادة المبالغ المستردة؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtythree" class="collapse " aria-labelledby="headingThirtythree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtyfour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtyfour" aria-expanded="true" aria-controls="collapseThirtyfour">
                            هل يمكنني استبدال منتج باستخدام  نظام آزورا؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtyfour" class="collapse " aria-labelledby="headingThirtyfour"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• لا ، يمكنك بدء استرداد ثم إجراء عملية بيع أخرى. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtyfive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtyfive" aria-expanded="true" aria-controls="collapseThirtyfive">
                            هل هناك رسوم معاملات أو رسوم مخفية يجب أن أقلق بشأنها؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtyfive" class="collapse " aria-labelledby="headingThirtyfive"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• لا. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtySix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtySix" aria-expanded="true" aria-controls="collapseThirtySix">
                            لدي بالفعل بعض الأجهزة. هل يمكنني إعادة استخدامها مع  نظام آزورا؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtySix" class="collapse " aria-labelledby="headingThirtySix"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• ليس في الوقت الحالي ، يعمل نظامنا حاليًا في أجهزتنا المقدمة ، ويوصى بالحصول على تجربة نظام آزورا المتكامل. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtySeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtySeven" aria-expanded="true" aria-controls="collapseThirtySeven">
                            لدي أكثر من موقع بيع بالتجزئة كيف سيكون الدفع؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtySeven" class="collapse " aria-labelledby="headingThirtySeven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• سيتم الدفع لكل موقع على حدة. </p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtyEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtyEight" aria-expanded="true" aria-controls="collapseThirtyEight">
                            كيف  يمكنني التبديل بسهولة بين المتاجر؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtyEight" class="collapse " aria-labelledby="headingThirtyEight"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>•  يحتوي كل متجر على لوحة إدارة خاصة به وحسابات منفصلة * ^ 20.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingThirtyNine">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThirtyNine" aria-expanded="true" aria-controls="collapseThirtyNine">
                            إلى متى يمكن إستمرار حسابي بدون أن  يحذف؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseThirtyNine" class="collapse " aria-labelledby="headingThirtyNine"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>•  15 يوم.</p>

                    </div>
                </div>


            </div>



            <div class="card">
                <div class="card-header" id="headingFourty">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourty" aria-expanded="true" aria-controls="collapseFourty">
                            هل يمكنني الحصول على نسخة احتياطية من بياناتي؟ وميزة لتنزيل جميع بياناتي؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourty" class="collapse " aria-labelledby="headingFourty"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• نعم.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFourtyone">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourtyone" aria-expanded="true" aria-controls="collapseFourtyone">
                          كم عدد الأجهزة والعملاء والموظفين و المنتجات التي يمكنني إنشاؤها؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourtyone" class="collapse " aria-labelledby="headingFourtyone"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• جهاز واحد والباقي غير محدود.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFourtytwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourtytwo" aria-expanded="true" aria-controls="collapseFourtytwo">
                            ما الذي يميز نظام آزورا؟<i class="fa"
                                aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourtytwo" class="collapse " aria-labelledby="headingFourtytwo"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• انظر إلى ميزات أزورا.</p>

                    </div>
                </div>


            </div>

            <div class="card">
                <div class="card-header" id="headingFourtythree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourtythree" aria-expanded="true" aria-controls="collapseFourtythree">
                            هل يوجد نسخة من النظام تعمل بالكمبيوتر؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourtythree" class="collapse " aria-labelledby="headingFourtythree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• ليس حاليا.</p>

                    </div>
                </div>


            </div>

            <div class="card">
            <div class="card-header" id="headingFourtyfive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtyfive" aria-expanded="true" aria-controls="collapseFourtyfive">
                        ليس لدي إتصال دائم بالإنترنت ؛ هل بإمكاني العمل بنظام آزورا بدون إنترنت؟<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtyfive" class="collapse " aria-labelledby="headingFourtyfive"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>• نعم  يمكنك ذلك، نحتاج إلى اتصال بالإنترنت كل يومين إلى ثلاثة أيام فقط لمنح نظامك نسخة احتياطية مشفرة ورفع بيانات متجرك إلى السحابة الشخصية الخاصة بك.</p>

                </div>
            </div>
            </div>


            <div class="card">
                <div class="card-header" id="headingFourtyfour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFourtyfour" aria-expanded="true" aria-controls="collapseFourtyfour">
                            كيف يمكنني الحصول على المساعدة؟<i class="fa" aria-hidden="true"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapseFourtyfour" class="collapse " aria-labelledby="headingFourtyfour"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <p>• فريق الدعم الفني لدينا متاح من الساعة ٨:۰۰ صباحًا حتى ٤:۰۰ مساءً ، للإجابة على أسئلتك ومساعدتك في أي مشكلة قد تواجهها مع النظام. أيضًا ، إذا كانت لديك أسئلة ، يسعدنا تقديم المساعدة عبر بريدنا الإلكتروني: <a href="mailto:info@azora.tech">info@azora.tech</a></p>

                    </div>
                </div>


            </div>




            </div>





        ';
    }
    else{
        echo '
        <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How to sign in to my account? <i class="fa" aria-hidden="true"></i>

                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>
                        Through the office of Azora POS.
                    </p>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        What features am I looking for? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <li>• Offline mode: Record sales and process credit card payments without an internet
                            connection.</li>
                        <li>• User accounts: Unlimited POS user accounts</li>
                        <li>• Product list: Add items to orders and track items per sale</li>
                        <li>• Inventory management: Using Azora’s built-in inventory tracking tools and sync in
                            real-time with your Azora online store</li>
                        <li>• Purchase order: Forecasting, purchase order tracking and store transfers</li>
                        <li>• Multi-location management: Track sales and inventory across multiple locations</li>
                        <li>• Staff sales tracking & management: Manage access and track sales by employee</li>
                        <li>• Managing customers debts: Send SMS and WhatsApp messages straight from your POS to
                            your
                            customers’ phones to show them their invoices periodically</li>
                        <li>• Android devices: you can view your store activity from any android device, our app
                            works
                            on any mobile, laptop, or desktop device with a browser.</li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        How does the POS manage inventory? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThree" class="collapse " aria-labelledby="headingThree"
                data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <li>• Insight into stock levels per location</li>
                        <li>• Reports on best-selling products and brands</li>
                        <li>• Automated reminders when you’re running low on stock</li>
                        <li>• Easy workflow for making purchase orders</li>
                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        Does the POS sync the in-store shopping experience to the web? <i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFour" class="collapse " aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <li>• Inventory, sales, customers and order requests are synchronized between in-store and
                            web</li>
                        <li>• Professionally designed, easy-to-use dashboard that do not require any technical
                            skills</li>
                        <li>• Built-in mobile-responsive website</li>

                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        Does the POS offer deep analysis and actionable reports? <i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFive" class="collapse " aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    <p>A good POS will not only show you how well you’re doing, but help you communicate more
                        effectively with your customers and identify opportunities for business growth.</p>
                    <ul>
                        <li>• Reports for most profitable products, top-selling products, lowest-selling products,
                            busiest store hours, top brands. </li>
                        <li>• Reports that show customer purchase history and employee performance</li>

                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        Is training and support part of what you’re buying? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseSix" class="collapse " aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <p>An onboarding session with a product specialist is key to getting started on the right foot
                        and continued access to technical support will see you through any issues.</p>
                    <ul>
                        <li>• Our technical support team who can provide on-site consultation, installation and
                            troubleshooting services. </li>
                        <li>• Variety of training materials, including a help center, community forum and online
                            resources</li>
                        <li>• Published customer satisfaction ratings</li>

                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingSeven">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        Is the system cloud-based? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseSeven" class="collapse " aria-labelledby="headingSeven"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>A cloud-based POS system allows you to access your reports data from wherever you are. It is
                        also scalable, and offers significantly lower infrastructure costs.</p>
                    <ul>
                        <li>• The ability to access your point of sale from any Android device, from anywhere </li>
                        <li>• Automated cloud-based data backups</li>


                    </ul>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingEight">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                        Can Azora POS work offline? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseEight" class="collapse " aria-labelledby="headingEight"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes</p>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingNine">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                        How do I view my full sales history? <i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseNine" class="collapse " aria-labelledby="headingNine" data-parent="#accordionExample">
                <div class="card-body">
                    <p>Open the reports page then open sales report and add date from and to.</p>
                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingTen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                        How do I access my Azora account from another device?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTen" class="collapse " aria-labelledby="headingTen" data-parent="#accordionExample">
                <div class="card-body">
                    <p>Through azora web page <a href="https://www.azora.tech/azora/login.php">www.azora.tech</a>
                    </p>
                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingEleven">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                        Can the customers pay their debts through a bank transfer?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseEleven" class="collapse " aria-labelledby="headingEleven"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>So far, we be integrating with some of the current e-wallets in Yemen to make this possible
                        for ex. mahfathty by TIIB</p>
                </div>
            </div>


        </div>




        <div class="card">
            <div class="card-header" id="headingTwelve">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                        How much time does it take to set up Azora POS?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwelve" class="collapse " aria-labelledby="headingTwelve"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>It depends on the amount of data that needs to be integrated</p>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
                        I have thousands of existing printed barcodes from my old POS, can I use these with Azora
                        POS?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirteen" class="collapse " aria-labelledby="headingThirteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes.</p>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
                        I’m not a techie person, will I have a hard time migrating my products and customers to
                        Azora POS?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourteen" class="collapse " aria-labelledby="headingFourteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>No, our team of technical support will take care of the migrating process and even do it for
                        you, our professional services can get you up and running in as little time possible. </p>
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFifteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFifteen" aria-expanded="true" aria-controls="collapseFifteen">
                        I’m already comfortable with my current POS system, is Azora POS really a better option?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFifteen" class="collapse " aria-labelledby="headingFifteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Most people who switch to Azora POS never look back. Merchants love the software’s
                        user-friendly and intuitive interface, as well as its features and integrations. </p>

                    <p>However, we understand that each business is unique and not all tools may be a good fit for
                        you. That’s why we invite you to take a tour of our software and see if it meets your needs.
                    </p>
                    <p>Finally, you can always talk to our trusty engineers for any specific questions or concerns
                        and they’ll help you decide if Azora POS really is right for you. Drop us a line at
                        <a href="mailto: info@azora.tech">info@azora.tech</a> or call at 01573062.
                    </p>
                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingSixteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseSixteen" aria-expanded="true" aria-controls="collapseSixteen">
                        I don’t live in Yemen, does Azora POS work in my country?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseSixteen" class="collapse " aria-labelledby="headingSixteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, Azora is not linked to a specific country since its cloud based</p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingSeventeen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseSeventeen" aria-expanded="true" aria-controls="collapseSeventeen">
                        I don’t like to get stuck if I have questions, can I call your support team any time?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseSeventeen" class="collapse " aria-labelledby="headingSeventeen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, our technical team is available form 8:00 am to 11:00 pm.</p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingEighteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseEighteen" aria-expanded="true" aria-controls="collapseEighteen">
                        I own a seasonal business. Can I cancel my subscription but still keep my data?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseEighteen" class="collapse " aria-labelledby="headingEighteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes.</p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingNineteen">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseNineteen" aria-expanded="true" aria-controls="collapseNineteen">
                        I don’t have a reliable Internet connection; can I still make Azora POS work for me?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseNineteen" class="collapse " aria-labelledby="headingNineteen"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, we need internet connection every two to three days just to give your system an
                        encrypted back-up to your personal cloud.</p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingTwenty">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwenty" aria-expanded="true" aria-controls="collapseTwenty">
                        I have more than one store, will Azora POS work for me?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwenty" class="collapse " aria-labelledby="headingTwenty"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, for premium special cases</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentyone">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentyone" aria-expanded="true" aria-controls="collapseTwentyone">
                        I don’t feel comfortable with web-based solutions, is my data safe in the cloud?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentyone" class="collapse " aria-labelledby="headingTwentyone"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, its encrypted by a 128 AES</p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingTwentytwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentytwo" aria-expanded="true" aria-controls="collapseTwentytwo">
                        I need someone to come over and set up my POS system. Does Azora POS do “house calls”?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentytwo" class="collapse " aria-labelledby="headingTwentytwo"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Our technical team will take care of that.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentythree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentythree" aria-expanded="true" aria-controls="collapseTwentythree">
                        I like Azora POS but don’t know where to start, what should I do next?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentythree" class="collapse " aria-labelledby="headingTwentythree"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p> Register through Azora website and our team will contact you shortly.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentyfour">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentyfour" aria-expanded="true" aria-controls="collapseTwentyfour">
                        Why should I use POS Software?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentyfour" class="collapse " aria-labelledby="headingTwentyfour"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>A POS system is software package that is frequently packaged with an accompanying compatible
                        hardware package used to organize and operate your business. The software links your
                        customer service, inventory, accounting and other departments within one program, which
                        helps centralize your administrative tasks. Using a POS is tremendously time-saving and
                        efficient compared with the alternative of using separate software to manage each area.
                        It can also improve the customer experience with efficient sales programming, reduce waste
                        with automated inventory reconciliation and expiration and ordering alerts, and prevent
                        theft.
                    </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentyfive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentyfive" aria-expanded="true" aria-controls="collapseTwentyfive">
                        How Much does Azora POS Cost?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentyfive" class="collapse " aria-labelledby="headingTwentyfive"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>We have three available bundles you can check at our link<a
                            href="https://www.azora.tech">www.azora.tech</a></p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentySix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentySix" aria-expanded="true" aria-controls="collapseTwentySix">
                        If the server should stop working, would the terminal be able to process a sale?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentySix" class="collapse " aria-labelledby="headingTwentySix"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes. Since our system works offline all functionalities are available.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentySeven">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentySeven" aria-expanded="true" aria-controls="collapseTwentySeven">
                        Can I transfer my data on a current POS to a new POS software system?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentySeven" class="collapse " aria-labelledby="headingTwentySeven"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Once you try Azora you will never look back. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentyEight">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentyEight" aria-expanded="true" aria-controls="collapseTwentyEight">
                        Can I analyze customer data with a POS?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentyEight" class="collapse " aria-labelledby="headingTwentyEight"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingTwentyNine">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwentyNine" aria-expanded="true" aria-controls="collapseTwentyNine">
                        Is there a limit to the number of products I can have in my catalog?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseTwentyNine" class="collapse " aria-labelledby="headingTwentyNine"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>No. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirty">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirty" aria-expanded="true" aria-controls="collapseThirty">
                        If I want to change the availability of a single/some products, how can I do that?<i
                            class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirty" class="collapse " aria-labelledby="headingThirty"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>You will open the product page and go to the product you want to pause and you turn off the
                        status button. </p>

                </div>
            </div>


        </div>


        <div class="card">
            <div class="card-header" id="headingThirtyone">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtyone" aria-expanded="true" aria-controls="collapseThirtyone">
                        Does the app work in every country and currency?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtyone" class="collapse " aria-labelledby="headingThirtyone"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtytwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtytwo" aria-expanded="true" aria-controls="collapseThirtytwo">
                        Can I use Azora POS if I have multiple retail outlets?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtytwo" class="collapse " aria-labelledby="headingThirtytwo"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtythree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtythree" aria-expanded="true" aria-controls="collapseThirtythree">
                        Can I use Azora POS if I have more than one employee?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtythree" class="collapse " aria-labelledby="headingThirtythree"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes, we have a local user system. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtyfour">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtyfour" aria-expanded="true" aria-controls="collapseThirtyfour">
                        Can I give refunds?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtyfour" class="collapse " aria-labelledby="headingThirtyfour"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtyfive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtyfive" aria-expanded="true" aria-controls="collapseThirtyfive">
                        Can I exchange an item using Azora POS?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtyfive" class="collapse " aria-labelledby="headingThirtyfive"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>No, you can initiate a refund and then make another sale. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtySix">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtySix" aria-expanded="true" aria-controls="collapseThirtySix">
                        Are there any transaction fees or hidden fees I should worry about?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtySix" class="collapse " aria-labelledby="headingThirtySix"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>No. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtySeven">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtySeven" aria-expanded="true" aria-controls="collapseThirtySeven">
                        I already own some hardware. Can I re-use it with Azora POS?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtySeven" class="collapse " aria-labelledby="headingThirtySeven"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Not at the moment, our system currently functions in our provided devices, and it is
                        recommended to have the full Azora experience. </p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtyEight">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtyEight" aria-expanded="true" aria-controls="collapseThirtyEight">
                        I have more than one retail location. How am I billed?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtyEight" class="collapse " aria-labelledby="headingThirtyEight"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Each location will be billed separately.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingThirtyNine">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseThirtyNine" aria-expanded="true" aria-controls="collapseThirtyNine">
                        How to easily switch between stores?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseThirtyNine" class="collapse " aria-labelledby="headingThirtyNine"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Each store has its own admin panel and separate accounts.</p>

                </div>
            </div>


        </div>



        <div class="card">
            <div class="card-header" id="headingFourty">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourty" aria-expanded="true" aria-controls="collapseFourty">
                        How long can my account not will be deleted?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourty" class="collapse " aria-labelledby="headingFourty"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>15 days.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourtyone">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtyone" aria-expanded="true" aria-controls="collapseFourtyone">
                        Can I get a backup of my data? and a feature to download all my data?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtyone" class="collapse " aria-labelledby="headingFourtyone"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Yes.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourtytwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtytwo" aria-expanded="true" aria-controls="collapseFourtytwo">
                        How many devices, customers, employees, items, can I create?<i class="fa"
                            aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtytwo" class="collapse " aria-labelledby="headingFourtytwo"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p> One device and unlimited the rest.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourtythree">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtythree" aria-expanded="true" aria-controls="collapseFourtythree">
                        What is unique about Azora POS ?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtythree" class="collapse " aria-labelledby="headingFourtythree"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p> Look at Azora features.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourtyfour">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtyfour" aria-expanded="true" aria-controls="collapseFourtyfour">
                        Is there a PC version?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtyfour" class="collapse " aria-labelledby="headingFourtyfour"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Not at the moment.</p>

                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-header" id="headingFourtyfive">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseFourtyfive" aria-expanded="true" aria-controls="collapseFourtyfive">
                        How can I get help?<i class="fa" aria-hidden="true"></i>
                    </button>
                </h2>
            </div>

            <div id="collapseFourtyfive" class="collapse " aria-labelledby="headingFourtyfive"
                data-parent="#accordionExample">
                <div class="card-body">
                    <p>Our technical support team is available from 8:00am to 4:00pm, to answer your questions and
                        help you with any issue you may face with the system. Also, if you have questions, we’re
                        glad to help over our email: <a href="mailto: info@azora.tech">info@azora.tech</a></p>

                </div>
            </div>


        </div>





    </div>
        ';
    }
    
    ?>
    </div>


</section