<script type="text/javascript" src="jquery/lib/jquery.js"></script>
<script type='text/javascript' src='jquery/lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='jquery/lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='jquery/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery/jquery.autocomplete.css" />
</head>
<body>

	<script>
	var availableTags = [ '정글북','워크래프트: 전쟁의 서막','아가씨'
	,'컨저링 2','특별수사: 사형수의 편지','B형남자친구','HAAN 한길수','6월의 일기','깃',
'공공의적2','그때그사람들','가능한 변화들','극장전','간큰가족','그리스 로마신화','가발','가문의 위기','거칠마루','강력3반','광식이 동생 광태','나는 나를 파괴할 권리가 있다','남극일기','녹색의자','너는 내운명','내 생애 가장 아름다운 일주일','나의 결혼원정기','달콤한 인생','댄서의 순정','동백꽃다섯은 너무 많아','레드아이러브토크','몽정기2','말아톤마파도','미스터 주부퀴즈왕','미스터 소크라테스','무영검','봄이 오면','분홍신','박수칠 때 떠나라','바리바리 짱','빛나는 거짓','별별 이야기','사랑니','새드무비','사랑해 말순씨','소년 천국에 가다','엄마','여자정혜','삼거리 무스탕 소년의 최후','역전의 명수','연애술사','안녕 형아','연애의 목적','여고괴담4-목소리','웰컴투동막골','왕후심청','이대로죽을순 없다','외출','오로라공주','야수와 미녀','용서받지 못한 자','애인','연애','왕의남자','제니주노','잠복근무','주먹이운다','종려나무 숲','작업의 정석','철수 영희','천군','친절한 금자씨','첼로','초승달과 담배','청연','키다리아저씨','태풍태양','태풍','파송송계란탁','프락치','파랑주의보','혈의누','활','형사','生, 날선생','그 집 앞','공즉시색','강적','가족의 탄생','공필두','구세주','항공남녀','구타 유발자들','국경의 남쪽','격투기 고등학교','가을로','각설탕','괴물','눈부신 날에','내 청춘에게 고함','탈콤 살벌한 연인','다섯개의 시선','달려라 장미','데이지','다세포 소녀','도마뱀','대한독립만세','디워','라이프 이즈 쿨','로망스','마음이','망종','무극','모노폴리','모두들 괜찮아요?','마이 캡틴 김대출','기봉이','바보','비열한 거리','백만장자의 첫사랑','보물섬','방과후 옥상','사과','스위트 드림','사이보그지만 괜찮아','싸움의 기술','사랑을 놓치다','썬데이 서울','신성일의 행방불명','손님은 왕이다','사생결단','소년','아파트','예의 없는 것들','울어도 좋습니까?','우리들의 행복한 시간','열혈남아','아빠 여기 웬일이세요?','우리에게 내일은 없다','온 더로드, 투','야수','음란서생','엄마찾아 삼만리','여교수의 은밀한 매력','연리지','중천','조용한 세상','잘살아보세','진주라 천리길','짝패','천년학','창공으로','청춘만화','착신아리 파이널','카리스마 탈출기','투사부일체','피터팬의 공식','폭력 써클','홀리데이','흡혈형사 나도열','호로비츠를 위하여','한반도','해바라기','쇼생크 탈출','주토피아','레옹','동주','터미네이터 2','인생은 아름다워','센과 치히로의 행방불명','죽은 시인의 사회','빽 투더 퓨쳐','매트릭스','월-E','반지의 제왕: 왕의 귀환','토이 스토리3','나 홀로 집에','살인의 추억','포레스트 검프','사운드 오브 뮤직','미세스 다웃파이어','굿바이 마이 프렌드','라이언 일병 구하기','에이리언 2','여인의 향기','아마데우스','울지마 톤즈','세 얼간이','패왕별희','헬프','타잔','클래식','글래디에이터','드래곤 길들이기','소원','모노노케 히메','집으로..','라푼젤','케스트 어웨이','컨저링 2','곡성','미 비포 유','닌자터틀 : 어둠의 히어로','덕혜옹주','엑스맨: 아포칼립스','계춘할망','무서운 이야기 3: 화성에서 온 소녀','본 투 비 블루','비밀은 없다','굿바이 싱글','싱 스트리트','사냥','부산행','트릭','나의 소녀시대','인천상륙작전','탐정 홍길동: 사라진 마을','루시드 드림','봉이 김선달','나우 유 씨 미 2','터널','오베라는 남자','수어사이드 스쿼드'];	</script>

	  <input type="text" id="searchbox" name="searchbox">

	<script>
	$(document).ready(function() {
	    $("#searchbox").autocomplete(availableTags,{ 
	        matchContains: true,
	        selectFirst: false
	    });
	});
	</script>
