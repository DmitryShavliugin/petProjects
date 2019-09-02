#include<iostream>
#include<windows.h>
#include<vector>
#include<time.h>
#include<algorithm>
#include"graphics.h"
using namespace std;

struct Bullet
{
	int x;
	int y;
	int radius;
};
struct Invader
{
    int x;
	int y;
	int img;
};

void initInvaders(vector<Invader>&inv)
{
	int xAlien = 0;
	int yAlien = 0;
		int a = SgLoadImage("alien.JPG");
		for(int i = 0;i < 8;i++)
		{
			Invader temp;
			temp.x = xAlien;
			temp.img = a;
			temp.y = yAlien;
			inv.push_back(temp);
			xAlien+=52+35;

		}
		yAlien+=85+42;
		int b = SgLoadImage("alien1.JPG");
		xAlien = 0;
		for(int i = 0;i < 8;i++)
		{
			Invader temp;
			temp.img = b;
			temp.x = xAlien;
			temp.y = yAlien;
		inv.push_back(temp);
		xAlien+=37+47;
		
		}
		xAlien = 0;
		yAlien+=85+47;
				int c = SgLoadImage("alien2.JPG");
		for(int i = 0;i < 8;i++)
		{
			Invader temp;
			temp.img = c;
			temp.x = xAlien;
			temp.y = yAlien;
			inv.push_back(temp);
			xAlien+=42+42;

		}
		yAlien+=82+41;

}



void drawInvaders(vector<Invader>&inv)
{
		for(int i = 0;i < static_cast<int>(inv. size()); i++)
		{
             SgDrawImage(inv[i].img,inv[i].x,inv[i].y);
		}
}
void moveInvadersRight(vector<Invader>&inv)
{
	for(int i = 0;i < static_cast<int>(inv.size()); i++)
	{
		inv[i]. x+=3;
	}
}

void moveInvadersLeft(vector<Invader>&inv)
{
	for(int i = 0; i < static_cast<int>(inv.size()); i++)
	{
		inv[i]. x-=3;
	}
}
void drawBullets(vector<Bullet>&bul)
{
	for(int i = 0;i < static_cast<int>(bul.size()); i++)
	{
		SgCircle(bul[i].x,bul[i].y,bul[i].radius);
	}
}

void moveBullets(vector<Bullet>&bul)
{
	for(int i = 0;i < static_cast<int>(bul.size());i++)
	{
		bul[i].y -= 5;
	}
}
bool checkBullet(Bullet b)
{
	if(b.y < 0)return true;
	else return false;
}
void removeBullets(vector<Bullet>& bul)
{
	bul.erase(remove_if(bul.begin(),bul.end(),checkBullet),bul.end());
}
void killInvaders(vector<Invader>&inv , vector<Bullet>&bul,int & score)
{
	if(inv.size()==0)
		return;
	int invWidth = 0,invHeight = 0;
	SgGetImageSizes(inv[0].img,invWidth,invHeight);

	for(int i = 0; i < static_cast<int>(inv.size()); i++)
	{
		int xCenter = inv[i].x+invWidth/2;
		int yCenter = inv[i].y+invHeight/2;
		for(int j = 0; j < static_cast<int>(bul.size()); j++)
		{
			double d = sqrt((double)(xCenter - bul[j].x)*(xCenter - bul[j].x)+((double)yCenter - bul[j].y)*(yCenter - bul[j].y));
			if(d<=16+bul[j].radius)
			{
				if(i < static_cast<int>(inv.size()))
				{
					inv.erase(inv.begin()+i);
				}
				if(j < static_cast<int>(bul.size()))
				{
					bul.erase(bul.begin()+j);
					score++;
				}
					
			}
		}
	}
} 

void main()
{
	SetConsoleOutputCP(1251);
	SgCreate(800,600,"Test");
	SgHideConsole();
	srand((unsigned)time(NULL));
		vector<Invader> inv;
		initInvaders(inv);
		int steps = 0;
		int direction = -1;
		int xPlatform = 335,yPlatform = 560;
		int imgPlatform = SgLoadImage("plata.JPG");
		vector<Bullet>bul;
		int CoolDown = 0;
		int score = 0;
	while(SgIsActive())
	{
		if (SgIsKeyDown(VK_LEFT) && xPlatform > 5)
		{
			xPlatform-=5;
		}
		if (SgIsKeyDown(VK_RIGHT) && xPlatform < 750)
		{
			xPlatform+=5;
		}
		if(SgIsKeyDown(VK_SPACE) && CoolDown == 0)
		{
			Bullet temp;
			temp.x = xPlatform +27;
			temp.y = yPlatform;
			temp.radius = 5;
			bul.push_back(temp);
			CoolDown = 25;
		}
		if(CoolDown > 0)
		{
			CoolDown--;
		}
		
		SgBeginDraw();
		SgClearScreen(sgRGB(0,0,0));
		if(inv.size()==0)
		{
			SgSelectFont(45,35,SgRGB(255,255,255));
			SgDrawText(200,300,"GJ, You Win");
			SgEndDraw();
			Sleep(5000);
			break;
		}
		SgSelectFont(25,15,SgRGB(255,255,255));
		SgDrawText(15,575,"Score:%d",score);
		drawBullets(bul);
        moveBullets(bul);
		removeBullets(bul);
{
	for(int i=0; i < static_cast<int>(bul.size()); i++)
	{
		bul[i].y-=5;
	}
}

		drawInvaders(inv);
		SgDrawImage(imgPlatform,xPlatform,yPlatform);
		if(direction==-1)
		{
			moveInvadersRight(inv);
		}
		else
		{
			moveInvadersLeft(inv);
		}
		steps++;
		if(steps > 42)
		{
			steps = 0;
			direction=direction*-1;
		}
		killInvaders(inv,bul,score);
		SgRectangle(760,590 - CoolDown * 2,790,590);
		SgEndDraw();
		SgPause(20);
	}
	SgDestroy();
}