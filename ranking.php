<style>

input[type='radio']{
	display: none;
}

label{
	font-size: 15px;
}

input[id='song']:checked~div.tab-item1{
	display: block;
}
input[id='movie']:checked~div.tab-item2{
	display: block;
}

div.tab-item1{
	display: none;
}
div.tab-item2{
	display: none;
}

section.tab-title>label{
	display: block;
	float: left;
	width: 100px;
	height: 30px;
	line-height: 30px;
	text-align: center;
	background: #8cc1ff;
	color: white;
}
.item{
	overflow: hidden;
	padding: 10px;
	border-top: none;

}
.description{
	margin-left: 10px;
	text-align: center;
}

</style>

<aside>
			<input id='song' type=radio name=tab checked=checked>
			<input id='movie' type=radio name=tab>

			<section class=tab-title>
				<label for=song>조회순</label>
				<label for=movie>평점순</label>
			</section>

			<div class="tab-item1">
				<ul>
					<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=122489'>
						<div class="description">
							<strong>정글북</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=75006'>
						<div class="description">
							<strong>워크래프트: 전쟁의 서막</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=123519'>
						<div class="description">
							<strong>아가씨</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=130720'>
						<div class="description">
							<strong>특별수사: 사형수의 편지</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=137915'>
						<div class="description">
							<strong>미 비포 유</strong>
						</div>
					</a>
						</li>
				</ul>
			</div>

			<div class='tab-item2'>
				<ul>
						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=22126'>
						<div class="description">
							<strong>인생은 아름다워</strong>
						</div>
					</a>
						</li>


						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=89752'>
						<div class="description">
							<strong>오페라의 유령</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=148338'>
						<div class="description">
							<strong>동급생</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=146488'>
						<div class="description">
							<strong>태양 아래</strong>
						</div>
					</a>
						</li>

						<li class="item">
						<a href='http://movie.naver.com/movie/bi/mi/basic.nhn?code=139613'>
						<div class="description">
							<strong>오베라는 남자</strong>
						</div>
					</a>
						</li>
				</ul>
			</div>
		</aside>