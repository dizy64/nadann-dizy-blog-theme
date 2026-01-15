# Nadann Dizy Blog - WordPress Theme

## 프로젝트 개요
미니멀하고 깔끔한 한국어 블로그 워드프레스 테마

## 현재 상태
- **버전**: 1.0.0
- **서버 배포**: bermuda:/home/ec2-user/html/whiteluv/wp-content/themes/nadann-dizy-blog/

## 디자인 특징
- 심플한 헤더 (배경 없음, 어두운 폰트)
- 본문 넓이: 960px
- 액센트 컬러: #0277bd (짙은 바다색)
- 폰트: 나눔스퀘어라운드
- 반응형 디자인

## 파일 구조
```
nadann-dizy-blog/
├── style.css       # 테마 정보 + 스타일
├── functions.php   # 테마 기능 (메뉴, 위젯, 커스터마이저)
├── header.php      # 공통 헤더
├── footer.php      # 푸터 + 위젯 영역 4개
├── index.php       # 홈/글 목록
├── single.php      # 개별 글
├── page.php        # 페이지
└── screenshot.png  # 테마 미리보기
```

---

## Claude 작업 지시사항

### 배포
서버 배포 시 아래 명령어 사용:
```bash
scp -r /Users/zero/Downloads/word-press-theme-creation/nadann-dizy-blog bermuda:/home/ec2-user/html/whiteluv/wp-content/themes/
```

### 추가 가능한 기능

#### 1. 댓글 템플릿 추가
- `comments.php` 파일 생성
- 스타일에 맞는 댓글 폼/목록 구현
- single.php에 `comments_template()` 호출 추가

#### 2. 아카이브 템플릿
- `archive.php` 생성 (카테고리/태그/날짜별 아카이브)
- `category.php`, `tag.php` 개별 템플릿 (선택)

#### 3. 404 페이지
- `404.php` 생성
- 사용자 친화적인 에러 페이지

#### 4. 검색 결과 페이지
- `search.php` 생성
- `searchform.php` 커스텀 검색 폼

#### 5. 사이드바 추가 (선택)
- `sidebar.php` 생성
- functions.php에 사이드바 위젯 영역 등록
- 2컬럼 레이아웃 스타일 추가

#### 6. 커스터마이저 확장
- 로고 이미지 업로드
- 액센트 컬러 변경
- 푸터 저작권 텍스트 수정

#### 7. 다국어 지원
- `languages/` 폴더 생성
- `.pot` 파일 생성
- 번역 함수 적용 확인

#### 8. 성능 최적화
- CSS 압축 (style.min.css)
- 조건부 스크립트 로딩

### 스타일 가이드

#### CSS 변수
```css
--color-bg: #fafafa;
--color-text: #1a1a1a;
--color-text-muted: #666666;
--color-border: #e5e5e5;
--color-accent: #0277bd;
```

#### 반응형 브레이크포인트
- 768px: 태블릿 (푸터 2열)
- 640px: 모바일 (푸터 1열)

### 테스트 체크리스트
- [ ] 글 목록 페이지 확인
- [ ] 개별 글 페이지 확인
- [ ] 페이지 템플릿 확인
- [ ] 모바일 반응형 확인
- [ ] 메뉴 동작 확인
- [ ] 위젯 영역 동작 확인
- [ ] 커스터마이저 설정 확인

### Git 워크플로우
```bash
# 변경 후 커밋
git add .
git commit -m "feat: 기능 설명"

# 서버 배포
scp -r . bermuda:/home/ec2-user/html/whiteluv/wp-content/themes/nadann-dizy-blog/
```

### 참고 경로
- 로컬: `/Users/zero/Downloads/word-press-theme-creation/nadann-dizy-blog/`
- 서버: `bermuda:/home/ec2-user/html/whiteluv/wp-content/themes/nadann-dizy-blog/`
- HTML 미리보기: `/Users/zero/Downloads/word-press-theme-creation/` (npx serve로 실행)
