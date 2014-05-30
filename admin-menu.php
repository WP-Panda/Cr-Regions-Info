<?php 
	add_action('admin_menu', 'register_my_custom_submenu_page');
	
	function register_my_custom_submenu_page() {
		add_submenu_page( 'tools.php', 'Cr Regions Info', 'Cr Regions Info', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page_callback' ); 
	}
	
	function my_custom_submenu_page_callback() {
		
		echo '<div class="wrap cr-region"><div id="icon-tools" class="icon32"></div>';
	echo '<h2>Список шорткодов</h2>'; ?>
	
	<h3 class='selecten'>1. Шорткоды для создания меню</h3>
	
	<ul class='firsten'>
		<li>
			<h4><span class='dashicons dashicons-marker'></span>Установка маркированного списка</h4>
			<p> 
				<span class='short'>[cr_ul][/cr_ul]</span><br>
				<span>Параметров не имеет</span><br>
				Возвращает -  <span class='back'>&lt;ul&gt;&lt;/ul&gt;</span>
			</p>
		</li>
		<li>
			<h4><span class='dashicons dashicons-marker'></span>Элемент Списка</h4>
				<span class='short'>[cr_li icon={}][/cr_li]</span>
			<h5>Параметры:</h5>
				<ul>
					<li><span>Icon</span> - url иконки</li>
				</ul>
				Возвращает -  &lt;li class='cr-menu-li'&gt;&lt;span class='cr-menu-span'&gt;&lt;img src="{url иконки}"&gt;&lt;/span&gt;&lt;/li&gt;
		</li>
		<li>
			<h4><span class='dashicons dashicons-marker'></span>Колонки</h4>
			<p>
				[cr_column width={} position={}][/cr_column]
				<h5>Параметры:</h5>
				<ul>
					<li><span>width</span> - ширина колонки (по умолчанию 30%)</li>
					<li><span>position</span> - добавляет классы для первой и последней колонки <span>first - первая, last - последняя</span></li>
				</ul>
				Возвращает -  &lt;div class='cr-columns {position}' style='width:{width}' &gt;&lt;/div&gt;
			</p>
		</li>
		<li>
			<h4><span class='dashicons dashicons-marker'></span>Очистка</h4>
			<p>
				[cr_clear]<br>
				<span>Параметров не имеет</span><br>
				Возвращает -  &lt;div class='cr-clear'&gt;&lt;/div&gt;<br>
				Рекомендется вставлять после использования колонок, для сброса обтекания
			</p>
		</li>
		<li>
			<h4><span class='dashicons dashicons-marker'></span>Использование</h4>
			<h5>Параметры:</h5>
			<p>
				[cr_column position=first][cr_ul][cr_li icon=http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][cr_li icon= http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][/cr_ul][/cr_column]<br>
				[cr_column position=first][cr_ul][cr_li icon=http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][cr_li icon= http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][/cr_ul][/cr_column]<br>
				[cr_column position=last][cr_ul][cr_li icon=http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][cr_li icon= http://www.wp-panda.panda/wp-content/uploads/2014/04/lightbulb.png]<a href="#">Пункт Астаны</a>[/cr_li][/cr_ul][/cr_column]<br>
				
				[cr_clear]
			</p>
			<h5>Результат:</h5>
			<img src="" alt="">
		</li>
	</ul>
	
	<h3 class='selecten'>2. Шорткод селекта региона</h3>	
	<ul class='firsten'>
		<li>
			<p>
				[cr_region_select]<br>
				<span>Параметров не имеет</span><br>
				Возвращает селект выбора региона, наполнение селекта происходит автоматически.
			</p>
		</li>
	</ul>
	
	<h3 class='selecten'>3. Шорткод вывода меню</h3>	
	<ul class='firsten'>
		<li>
			<p>
				[cr_region_menu]<br>
				<span>Параметров не имеет</span><br>
				Возвращает Меню Регионов, По умолчанию выводит меню первого региона из селекта, дальше выбранный.
			</p>
		</li>
	</ul>
	
	<h3 class='selecten'>4. Шорткод вывода ,баннера</h3>	
	<ul class='firsten'>
		<li>
			<p>
				[cr_region_menu tag={} w={} h={} crop={} class={}]<br>
				Возвращает Баннер Регионов определенный меткой, По умолчанию выводит меню первого региона из селекта, дальше выбранный.
				<h5>Параметры:</h5>
				<ul>
					<li><span>w</span> - ширина баннера</li>
					<li><span>h</span> - высота баннера</li>
					<li><span>crop</span> - строгая обрезка или масштабирование (может принимать true или false)</li>
					<li><span>tag</span> - идентификатор (код) баннера</li>
					<li><span>class</span> - дополнительный класс, параметр не обязательный</li>
				</ul>
				Возвращает Меню Регионов, По умолчанию выводит меню первого региона из селекта, дальше выбранный.<br>
				&lt;div class='banner-region'&gt;<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href='{href}'&gt;&lt;img class='{class}' src='{url}'  alt=''&gt;&lt;/a&gt;<br>
				&lt;/div&gt;
			</p>
		</li>
	</ul>
	<p>
		<span>Все шорткоды из блока выше можно использовать в записях, постах виджетах, например для вывода в каждой записи своего баннера для своего региона.</span>
	</p>
	
	<h2>Наполнение.</h2>
	<ul>
		<li> 1. Необходимо завести регионы, для этого Необходимо в меню административной части сайта выбрать пункт Информация, в нем подпункт регионы. В выбранной вкладке ввести регионы. ВНИМАНИЕ!!! для корректной работы Ярлык(слаг) должен быть набран латиницей.</li>
		<li>2. Дальше можно добавлять меню и баннеры, для этого Необходимо в меню административной части сайта выбрать пункт Информация, в нем выбрать подпункт Добавить новую.
			<ul>
				<li> Меню 
					<ul>
						<li>В правом верхнем блоке Тип Записи выбрать в селекте тип Меню.</li>
						<li>В правом блоке Регионы выбрать Регион Меню.</li>
						<li>Для идентификации меню Ввести название меню, например Меню Астана, данное название нигде не используется, но заводить необходимо.</li>
						<li>В области контента построить меню с помощью шорткодов, их можно и не использовать но с ними будет удобнее.</li>
					</ul>
				</li>
				<li> Баннер 
					<ul>
						<li>В правом верхнем блоке Тип Записи выбрать в селекте тип Баннер.</li>
						<li>В правом верхнем блоке Тип Записи Ввести в поле Ссылка с баннера Ссылку.</li>
						<li>В правом верхнем блоке Тип Записи Ввести в поле Koд баннера, индивидуальный идентификатор группы баннера, должен быть одинаковым у всех баннеров регионов отображаемых в однной с ним группе (например banner_1). </li>
						<li>Для идентификации баннера Ввести название баннера, например Баннер Астана 1, данное название нигде не используется, но заводить необходимо.</li>
						<li>В правом блоке миниатюра записи установить Изображение Баннера.</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	
	<h2>Вывод.</h2>
	<ul>
		<li> Любой блок в записи можно вывести с помощю соответствующего шорткода. </li>
		<li>В коде с помощю шорткода но обеpнув его функцией &lt;php echo do_shortcode( [шорткод] ); ?&gt;</li>
		<li>С помощю функций
			<ul>
				<li>&lt;?php echo cr_region_select(); ?&gt;  - Селектор Регионов</li>
				<li>&lt;?php echo get_cr_region_menu(); ?&gt;  - Меню Регионов</li>
				<li>&lt;?php echo get_cr_region_banner($tag,$w,$h,$crop,$class=null); ?&gt;  -Баннер Регионов
					<ul>
						<li><h3>Параметры те же что и у шорткода</h3></li>
						<li>$tag - идентификатор</li>
						<li>$w - ширина</li>
						<li>$h - высота</li>
						<li>$crop - обрезка (true,false)</li>
						<li>$class - дополнительный класс ( параметр необязательный )</li>
						<li>Пример использования &lt;?php echo get_cr_region_banner('banner_1',150, 220, true ); ?&gt;</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	
	<?php echo '</div>';
		
	}	