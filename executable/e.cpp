#include "opencv2/opencv.hpp"
#include<string>
#include<bits/stdc++.h>
#include<iostream>
using namespace std;
using namespace cv;
std::vector<cv::Rect> detectLetters(cv::Mat img)
{
    std::vector<cv::Rect> boundRect;
    cv::Mat img_gray, img_sobel, img_threshold, element;
    cvtColor(img, img_gray, CV_BGR2GRAY);
    cv::Sobel(img_gray, img_sobel, CV_8U, 1, 0, 3, 1, 0, cv::BORDER_DEFAULT);
    cv::threshold(img_sobel, img_threshold, 0, 255, CV_THRESH_OTSU+CV_THRESH_BINARY);
    cv::normalize(img_threshold,img_threshold,0,255,NORM_MINMAX,CV_8UC1);
    cv::imwrite("I:/test.jpg",img_gray);
    element = getStructuringElement(cv::MORPH_RECT, cv::Size(17, 3) );
    cv::morphologyEx(img_threshold, img_threshold, CV_MOP_CLOSE, element); //Does the trick
    std::vector< std::vector< cv::Point> > contours;
    cv::findContours(img_threshold, contours, 0, 1);
    std::vector<std::vector<cv::Point> > contours_poly( contours.size() );
    //cv::imwrite( "I:/test.jpg", img_gray);
    for( int i = 0; i < contours.size(); i++ )
        if (contours[i].size()>100)
        {
            cv::approxPolyDP( cv::Mat(contours[i]), contours_poly[i], 3, true );
            cv::Rect appRect( boundingRect( cv::Mat(contours_poly[i]) ));
            if (appRect.width>appRect.height)
                boundRect.push_back(appRect);
        }
    return boundRect;
}
string conv(int i){
string st="";
int temp;
while(i>0)
    {
        temp=i%10;
        st+=(temp+'0');
        i/=10;
    }

//cout<<st<<endl;
int len=st.length();
for(int i=0;i<len/2;i++){

        char temp=st[i];
        st[i]=st[len-i-1];
        st[len-i-1]=temp;
}
    return st;
}
int main(int argc, char** argv)
{
    //Read
    ofstream cout("out.txt");
    string inFile,outFile;
    if(argc == 3){
        inFile = argv[1];
        outFile = argv[2];
        cout << "HUA AYA\n";
    }
    else{
        cout << "ERROR AYA\n";
        cout << argc;

        return true;
    }

    cv::Mat img1=cv::imread(inFile);

    //Detect
    std::vector<cv::Rect> letterBBoxes1=detectLetters(img1);
    //Display
    Mat s;Rect r;
    for(int i=letterBBoxes1.size()-1; i>=0; i--){
        cv::rectangle(img1,letterBBoxes1[i],cv::Scalar(0,255,0),3,8,0);
        s=img1(letterBBoxes1[i]);
        imwrite("folder/con"+conv(i)+".jpg",s);
            }
   // cv::imwrite( "I:/TEST.jpg", img1);
    string put = "tesseract " + inFile + " " + outFile;
    char putC[put.length()];
    for(int i = 0;i < put.length(); ++i)
        putC[i] = put[i];
    system(putC);

    return 0;

}
